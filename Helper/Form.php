<?php
namespace MagePrakash\Helpdesk\Helper;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;

class Form extends Config
{
    protected $formId;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $postData = null;

    public function setFormId($formId)
    {
        $this->formId = $formId;
        return $this;
    }

    /**
     * Get author name
     *
     * @return string
     */
    public function getAuthorName()
    {
        $userName = $this->getPostValue('author_name');
        if (!empty($userName)) {
            return $userName;
        }

        return parent::getUserName();
    }

    /**
     * Get user name
     *
     * @return string
     */
    public function getUserName()
    {
        $userName = $this->getPostValue('customer_name');
        if (!empty($userName)) {
            return $userName;
        }

        return parent::getUserName();
    }

    /**
     * Get user email
     *
     * @return string
     */
    public function getUserEmail()
    {
        $userName = $this->getPostValue('email');
        if (!empty($userName)) {
            return $userName;
        }
        return parent::getUserEmail();
    }

    /**
     * Get message text
     *
     * @return string
     */
    public function getText($param = 'text')
    {
        $text = $this->getPostValue($param);
        if (!empty($text)) {
            return $text;
        }

        return '';
    }

    /**
     *
     * @param  string $key
     * @return string
     */
    public function getPostValue($key)
    {
        $formId = $this->formId;
        if (!isset($this->postData[$formId])) {
            $dataPersistor = $this->getDataPersistor();
            $postData = [];
            if ($dataPersistor) {
                $postData = (array) $this->getDataPersistor()->get($formId);
                // $this->getDataPersistor()->clear($formId);
            }
            $this->postData[$formId] = $postData;
        }

        if (isset($this->postData[$formId][$key])) {
            return (string) $this->postData[$formId][$key];
        }

        return '';
    }

    /**
     * Get Data Persistor
     *
     * @return DataPersistorInterface
     */
    protected function getDataPersistor()
    {
        $class = \Magento\Framework\App\Request\DataPersistor::class;
        if (!class_exists($class, false)) {
            return false;
        }

        if ($this->dataPersistor === null) {
            $this->dataPersistor = ObjectManager::getInstance()
                ->get(DataPersistorInterface::class);
        }

        return $this->dataPersistor;
    }
}
