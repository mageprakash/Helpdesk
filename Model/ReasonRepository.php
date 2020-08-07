<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace MagePrakash\Helpdesk\Model;

use MagePrakash\Helpdesk\Api\Data\ReasonInterfaceFactory;
use MagePrakash\Helpdesk\Api\Data\ReasonSearchResultsInterfaceFactory;
use MagePrakash\Helpdesk\Api\ReasonRepositoryInterface;
use MagePrakash\Helpdesk\Model\ResourceModel\Reason as ResourceReason;
use MagePrakash\Helpdesk\Model\ResourceModel\Reason\CollectionFactory as ReasonCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class ReasonRepository implements ReasonRepositoryInterface
{

    protected $resource;

    protected $dataObjectHelper;

    protected $extensibleDataObjectConverter;
    protected $reasonCollectionFactory;

    private $storeManager;

    protected $dataReasonFactory;

    protected $dataObjectProcessor;

    protected $searchResultsFactory;

    private $collectionProcessor;

    protected $extensionAttributesJoinProcessor;

    protected $reasonFactory;


    /**
     * @param ResourceReason $resource
     * @param ReasonFactory $reasonFactory
     * @param ReasonInterfaceFactory $dataReasonFactory
     * @param ReasonCollectionFactory $reasonCollectionFactory
     * @param ReasonSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceReason $resource,
        ReasonFactory $reasonFactory,
        ReasonInterfaceFactory $dataReasonFactory,
        ReasonCollectionFactory $reasonCollectionFactory,
        ReasonSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->reasonFactory = $reasonFactory;
        $this->reasonCollectionFactory = $reasonCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataReasonFactory = $dataReasonFactory;
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
        \MagePrakash\Helpdesk\Api\Data\ReasonInterface $reason
    ) {
        /* if (empty($reason->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $reason->setStoreId($storeId);
        } */
        
        $reasonData = $this->extensibleDataObjectConverter->toNestedArray(
            $reason,
            [],
            \MagePrakash\Helpdesk\Api\Data\ReasonInterface::class
        );
        
        $reasonModel = $this->reasonFactory->create()->setData($reasonData);
        
        try {
            $this->resource->save($reasonModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the reason: %1',
                $exception->getMessage()
            ));
        }
        return $reasonModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($reasonId)
    {
        $reason = $this->reasonFactory->create();
        $this->resource->load($reason, $reasonId);
        if (!$reason->getId()) {
            throw new NoSuchEntityException(__('reason with id "%1" does not exist.', $reasonId));
        }
        return $reason->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->reasonCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \MagePrakash\Helpdesk\Api\Data\ReasonInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
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
        \MagePrakash\Helpdesk\Api\Data\ReasonInterface $reason
    ) {
        try {
            $reasonModel = $this->reasonFactory->create();
            $this->resource->load($reasonModel, $reason->getReasonId());
            $this->resource->delete($reasonModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the reason: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($reasonId)
    {
        return $this->delete($this->get($reasonId));
    }
}

