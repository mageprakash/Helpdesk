<?php


namespace MagePrakash\Helpdesk\Model\Data;

use MagePrakash\Helpdesk\Api\Data\TicketMessageInterface;
use MagePrakash\Helpdesk\Model\Upload;

class TicketMessage extends \Magento\Framework\Api\AbstractExtensibleObject implements TicketMessageInterface
{
    protected $_storeManager;
    protected $filterProvider;

    public function __construct(
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ){
        $this->filterProvider = $filterProvider;
        $this->_storeManager = $storeManager;
    }

    /**
     * Get ticket_message_id
     * @return string|null
     */
    public function getTicketMessageId()
    {
        return $this->_get(self::TICKET_MESSAGE_ID);
    }

    /**
     * Set ticket_message_id
     * @param string $ticketMessageId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setTicketMessageId($ticketMessageId)
    {
        return $this->setData(self::TICKET_MESSAGE_ID, $ticketMessageId);
    }

    /**
     * Get ticket_id
     * @return string|null
     */
    public function getTicketId()
    {
        return $this->_get(self::TICKET_ID);
    }

    /**
     * Set ticket_id
     * @param string $ticketId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setTicketId($ticketId)
    {
        return $this->setData(self::TICKET_ID, $ticketId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \MagePrakash\Helpdesk\Api\Data\TicketMessageExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get email_message_id
     * @return string|null
     */
    public function getEmailMessageId()
    {
        return $this->_get(self::EMAIL_MESSAGE_ID);
    }

    /**
     * Set email_message_id
     * @param string $emailMessageId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setEmailMessageId($emailMessageId)
    {
        return $this->setData(self::EMAIL_MESSAGE_ID, $emailMessageId);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get text
     * @return string|null
     */
    public function getText()
    {
        return $this->filterProvider->getBlockFilter()->filter($this->_get(self::TEXT));
    }

    /**
     * Set text
     * @param string $text
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setText($text)
    {
        return $this->setData(self::TEXT, $text);
    }

    /**
     * Get file
     * @return string|null
     */
    public function getFile()
    {
        return $this->_get(self::FILE);
    }

    /**
     * Set file
     * @param string $file
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setFile($file)
    {
        return $this->setData(self::FILE, $file);
    }

    /**
     * Get user_id
     * @return string|null
     */
    public function getUserId()
    {
        return $this->_get(self::USER_ID);
    }

    /**
     * Set user_id
     * @param string $userId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setUserId($userId)
    {
        return $this->setData(self::USER_ID, $userId);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get priority_id
     * @return string|null
     */
    public function getPriorityId()
    {
        return $this->_get(self::PRIORITY_ID);
    }

    /**
     * Set priority_id
     * @param string $priority_id
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setPriorityId($priorityId)
    {
        return $this->setData(self::PRIORITY_ID, $priorityId);
    }

    /**
     * Get department_id
     * @return string|null
     */
    public function getDepartmentId()
    {
        return $this->_get(self::DEPARTMENT_ID);
    }

    /**
     * Set department_id
     * @param string $departmentId
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setDepartmentId($departmentId)
    {
        return $this->setData(self::DEPARTMENT_ID, $departmentId);
    }

    /**
     * Get enabled
     * @return string|null
     */
    public function getEnabled()
    {
        return $this->_get(self::ENABLED);
    }

    /**
     * Set enabled
     * @param string $enabled
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setEnabled($enabled)
    {
        return $this->setData(self::ENABLED, $enabled);
    }

    /**
     * Get reply_by
     * @return string|null
     */
    public function getReplyBy()
    {
        return $this->_get(self::REPLY_BY);
    }

    /**
     * Set reply_by
     * @param string $replyBy
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setReplyBy($replyBy)
    {
        return $this->setData(self::REPLY_BY, $replyBy);
    }

    /**
     * Get department_name
     * @return string|null
     */
    public function getDepartmentName()
    {
        return $this->_get(self::DEPARTMENT_NAME);
    }

    /**
     * Set department_name
     * @param string $departmentName
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setDepartmentName($departmentName)
    {
        return $this->setData(self::DEPARTMENT_NAME, $departmentName);
    }
    
    /**
     * Get status_name
     * @return string|null
     */
    public function getStatusName()
    {
        return $this->_get(self::STATUS_NAME);
    }
    
    /**
     * Set status_name
     * @param string $statusName
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setStatusName($statusName)
    {
        return $this->setData(self::STATUS_NAME, $statusName);
    }
    
    /**
     * Get priority_label
     * @return string|null
     */
    public function getPriorityLabel()
    {
        return $this->_get(self::PRIORITY_LABEL);
    }
    
    /**
     * Set priority_label
     * @param string $priorityLabel
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setPriorityLabel($priorityLabel)
    {
        return $this->setData(self::PRIORITY_LABEL, $priorityLabel);
    }

    public function getMediaUrl($path)
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA). Upload::HELPDESK_ATTACHMENT_PATH . $path;
    }
    /**
     * Get filename
     * @return mixed
     */
    public function getFilename()
    {
        $fileList = [];
        
        if($this->_get(self::FILENAME))
        {
            $filenames = explode(",", $this->_get(self::FILENAME));
            
            if(!empty($filenames))
            {
                foreach ($filenames as $value){
                    if($value)
                    $value = $this->getMediaUrl($value);
                    $path = parse_url($value, PHP_URL_PATH);
                    $fileList[basename($path)] =  $value;
                }
            }
        }
        return $fileList;
    }
    
    /**
     * Set filename
     * @param string $filename
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setFilename($filename)
    {
        return $this->setData(self::FILENAME, $filename);
    }

    /**
     * Get filepath
     * @return string|null
     */
    public function getFilepath()
    {
        return $this->_get(self::FILEPATH);
    }
    
    /**
     * Set filepath
     * @param string $filepath
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setFilepath($filepath)
    {
        return $this->setData(self::FILEPATH, $filepath);
    }


    /**
     * Get filesize
     * @return string|null
     */
    public function getFilesize()
    {
        return $this->_get(self::FILESIZE);
    }
    
    /**
     * Set filesize
     * @param string $filesize
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setFilesize($filesize)
    {
        return $this->setData(self::FILESIZE, $filesize);
    }

    /**
     * Get filetype
     * @return string|null
     */
    public function getFiletype()
    {
        return $this->_get(self::FILETYPE);
    }
    
    /**
     * Set filetype
     * @param string $filetype
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setFiletype($filetype)
    {
        return $this->setData(self::FILETYPE, $filetype);
    }

    /**
     * Get author_email
     * @return string|null
     */
    public function getAuthorEmail()
    {
        return $this->_get(self::AUTHOR_EMAIL);
    }
    
    /**
     * Set author_email
     * @param string $authoremail
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setAuthorEmail($authoremail)
    {
        return $this->setData(self::AUTHOR_EMAIL, $authoremail);
    }

    /**
     * Get author_name
     * @return string|null
     */
    public function getAuthorName()
    {
        return $this->_get(self::AUTHOR_NAME);
    }
    
    /**
     * Set author_name
     * @param string $authorname
     * @return \MagePrakash\Helpdesk\Api\Data\TicketMessageInterface
     */
    public function setAuthorName($authorname)
    {
        return $this->setData(self::AUTHOR_NAME, $authorname);
    }
}
