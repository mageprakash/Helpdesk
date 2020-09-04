<?php

namespace MagePrakash\Helpdesk\Model\ResourceModel\Ticket\Grid;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Search\AggregationInterface;
use MagePrakash\Helpdesk\Model\ResourceModel\Ticket\Collection as GridCollection;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\DB\Adapter\AdapterInterface;
use MagePrakash\Helpdesk\Model\ResourceModel\Ticket;
/**
 * Class Collection
 * Collection for displaying grid
 */
class Collection extends GridCollection implements SearchResultInterface
{
    /**
     * Resource initialization
     * @param EntityFactoryInterface   $entityFactory,
     * @param LoggerInterface          $logger,
     * @param FetchStrategyInterface   $fetchStrategy,
     * @param ManagerInterface         $eventManager,
     * @param StoreManagerInterface    $storeManager,
     * @param String                   $mainTable,
     * @param String                   $eventPrefix,
     * @param String                   $eventObject,
     * @param String                   $resourceModel,
     * @param $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
     * @param AdapterInterface        $connection = null,
     * @param AbstractDb              $resource = null
     * @return $this
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        $mainTable="mageprakash_helpdesk_ticket",
        $eventPrefix,
        $eventObject,
        $resourceModel = Ticket::class,
        $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $connection,
            $resource
        );
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
        $this->addFilterToMap('department_name', 'department.name');
        $this->addFilterToMap('priority_name', 'priority.name');
        $this->addFilterToMap('status_name', 'status.name');
    }

    protected function _renderFiltersBefore()
    {
        
        $this->getSelect()->joinLeft(
            ['department' => $this->getTable('mageprakash_helpdesk_department')],
            'main_table.department_id = department.department_id',
            ['department_name' => 'department.name']
        );
        
        $this->getSelect()->joinLeft(
            ['priority' => $this->getTable('mageprakash_helpdesk_priority')],
            'main_table.priority_id = priority.priority_id',
            ['priority_name' => 'priority.name']
        );

        $this->getSelect()->joinLeft(
            ['status' => $this->getTable('mageprakash_helpdesk_status')],
            'main_table.status_id = status.status_id',
            ['status_name' => 'status.name']
        );

        $this->getSelect()->joinLeft(
            ['customer_entity' => $this->getTable('customer_entity')],
            'main_table.customer_id = customer_entity.entity_id',
            ['customer_full_name' => 'CONCAT(customer_entity.firstname," ",customer_entity.lastname)']
        );

        $this->getSelect()->joinLeft(
            ['admin_user' => $this->getTable('admin_user')],
            'main_table.user_id = admin_user.user_id',
            ['admin_user_full_name' => 'CONCAT(admin_user.firstname," ",admin_user.lastname)']
        );
        
        parent::_renderFiltersBefore();
    }

    public function addFieldToFilter($field, $condition = null)
    {
        return parent::addFieldToFilter($field, $condition);
    }

    /**
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     *
     * @return $this
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ) {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}