<?php


namespace MagePrakash\Helpdesk\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use MagePrakash\Helpdesk\Api\TicketMessageRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use MagePrakash\Helpdesk\Api\Data\TicketMessageSearchResultsInterfaceFactory;
use MagePrakash\Helpdesk\Api\Data\TicketMessageInterfaceFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\CouldNotDeleteException;
use MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage as ResourceTicketMessage;
use Magento\Framework\Api\DataObjectHelper;
use MagePrakash\Helpdesk\Model\ResourceModel\TicketMessage\CollectionFactory as TicketMessageCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class TicketMessageRepository implements TicketMessageRepositoryInterface
{

    protected $extensionAttributesJoinProcessor;

    protected $searchResultsFactory;

    protected $dataTicketMessageFactory;

    protected $dataObjectProcessor;

    protected $ticketMessageFactory;

    protected $dataObjectHelper;

    private $storeManager;

    protected $extensibleDataObjectConverter;
    protected $resource;

    private $collectionProcessor;

    protected $ticketMessageCollectionFactory;


    /**
     * @param ResourceTicketMessage $resource
     * @param TicketMessageFactory $ticketMessageFactory
     * @param TicketMessageInterfaceFactory $dataTicketMessageFactory
     * @param TicketMessageCollectionFactory $ticketMessageCollectionFactory
     * @param TicketMessageSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceTicketMessage $resource,
        TicketMessageFactory $ticketMessageFactory,
        TicketMessageInterfaceFactory $dataTicketMessageFactory,
        TicketMessageCollectionFactory $ticketMessageCollectionFactory,
        TicketMessageSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->ticketMessageFactory = $ticketMessageFactory;
        $this->ticketMessageCollectionFactory = $ticketMessageCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTicketMessageFactory = $dataTicketMessageFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface $ticketMessage
    ) {
        /* if (empty($ticketMessage->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $ticketMessage->setStoreId($storeId);
        } */
        
        $ticketMessageData = $this->extensibleDataObjectConverter->toNestedArray(
            $ticketMessage,
            [],
            \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface::class
        );
        
        $ticketMessageModel = $this->ticketMessageFactory->create()->setData($ticketMessageData);
        
        try {
            $this->resource->save($ticketMessageModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the ticketMessage: %1',
                $exception->getMessage()
            ));
        }
        return $ticketMessageModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($ticketMessageId)
    {
        $ticketMessage = $this->ticketMessageFactory->create();
        $this->resource->load($ticketMessage, $ticketMessageId);
        if (!$ticketMessage->getId()) {
            throw new NoSuchEntityException(__('ticket_message with id "%1" does not exist.', $ticketMessageId));
        }
        return $ticketMessage->getDataModel();
    }

    public function getMessageList($ticketId) {
        $ticketMessageCollection = $this->ticketMessageCollectionFactory->create();
        $ticketMessageCollection->addDepartmentNameToSelect()
            ->addFieldToFilter('main_table.ticket_id',$ticketId)
            ->addCustomerIdToSelect()
            ->addCustomerEmailToSelect()
            ->addAdminUserEmailToSelect()
            ->addEmailToSelect()
            ->addStatusNameToSelect()
            ->addPriorityToSelect()
            ->addFilterByEnabled()
            ->addAttachmentToSelect()
            ->setOrder('main_table.ticket_message_id', \Magento\Framework\Data\Collection::SORT_ORDER_DESC);

        $ticketMessageCollection->getSelect()->group('ticket_message_id');

        return $ticketMessageCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->ticketMessageCollectionFactory->create();
        //$collection->addFieldToSelect('*');

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $collection
            ->addDepartmentNameToSelect()
            ->addStatusNameToSelect()
            ->addPriorityToSelect()
            ->addAttachmentToSelect()
            ->addFilterByEnabled(); 

        $collection->getSelect()->group('ticket_message_id');
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface $ticketMessage
    ) {
        try {
            $ticketMessageModel = $this->ticketMessageFactory->create();
            $this->resource->load($ticketMessageModel, $ticketMessage->getTicketMessageId());
            $this->resource->delete($ticketMessageModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the ticket_message: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($ticketMessageId)
    {
        return $this->delete($this->getById($ticketMessageId));
    }
}
