<?php
namespace MagePrakash\Helpdesk\Helper;

use Magento\Contact\Helper\Data as ContactHelper;
use Magento\Customer\Helper\View as CustomerViewHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends ContactHelper
{
    const CONFIG_XML_PATH_ENABLE                        = 'helpdesks/general/enable';
    const CONFIG_XML_PATH_CRON_ENABLE                   = 'helpdesks/general/cron';
    const CONFIG_XML_PATH_CONTACT_ENABLE                = 'helpdesks/general/contact';
    const CONFIG_XML_PATH_IS_ALLOWED_GUEST              = 'helpdesks/general/guest';
    const CONFIG_XML_PATH_ALLOWED_EXTENSION             = 'helpdesks/general/allow_attachments';
    const CONFIG_XML_PATH_MAIL_CUSTOMER_NOTIFICATION    = 'helpdesks/mail/customer_notification';
    const CONFIG_XML_PATH_MAIL_ADMIN_NOTIFICATION       = 'helpdesks/mail/admin_notification';
    const CONFIG_XML_PATH_MAIL_BLICKLIST                = 'helpdesks/mail/blacklist';
    const CONFIG_XML_PATH_MAIL_ARCHIVEMAIL              = 'helpdesks/mail/archive';
    const CONFIG_XML_PATH_NEW_STATUS_TICKET             = 'helpdesks/general/tickets_status_new';
    const CONFIG_XML_PATH_CLOSE_STATUS_TICKET           = 'helpdesks/general/tickets_status_close';
    const CONFIG_XML_PATH_AUTO_CLOSE_TICKET             = 'helpdesks/general/auto_close';
    const CONFIG_XML_PATH_AUTO_CLOSE_TICKET_DAYS        = 'helpdesks/general/auto_close_days';
    const CONFIG_XML_PATH_AUTO_CLOSE_TICKET_STATUS_SKIP = 'helpdesks/general/auto_close_status_skip';
    const TICKET_MESSAGE_CLOSE_STATUS_TEXT              = "Ticket Close By Client.";
    const TICKET_MESSAGE_CUSTOMER                       = 1;
    const TICKET_MESSAGE_ADMIN                          = 2;

    

    /**
     *
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;

    /**
     *
     * @var \Magento\User\Model\UserFactory
     */
    protected $userFactory;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param CustomerViewHelper $customerViewHelper
     * @param \Magento\Customer\Model\CustomerFactory $customerFactory;
     * @param \Magento\User\Model\UserFactory $userFactory
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        CustomerViewHelper $customerViewHelper,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\User\Model\UserFactory $userFactory
    ) {
        $this->customerFactory = $customerFactory;
        $this->userFactory = $userFactory;

        parent::__construct($context, $customerSession, $customerViewHelper);
    }

    /**
     * @param  int  $store
     * @param  string $key
     * @return mixed
     */
    private function getConfig($key)
    {
        return $this->scopeConfig->getValue(
            $key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     *
     * @param  int  $store
     * @return boolean
     */
    public function isEnabled($store = null)
    {
        return $this->getConfig(self::CONFIG_XML_PATH_ENABLE, $store);
    }


    /**
     * @param  int  $store
     * @return boolean
     */
    public function isCustomerNotificationEnabled($store = null)
    {
        return $this->getConfig(self::CONFIG_XML_PATH_MAIL_CUSTOMER_NOTIFICATION, $store);
    }

    /**
     * @param  int  $store
     * @return boolean
     */
    public function isAdminNotificationEnabled($store = null)
    {
        return $this->getConfig(self::CONFIG_XML_PATH_MAIL_ADMIN_NOTIFICATION, $store);
    }

    /**
     *
     * @return boolean
     */
    public function isAttachingEnable()
    {
        return $this->getConfig(self::CONFIG_XML_PATH_ATACHING_ENABLE);
    }

    /**
     *
     * @return string
     */
    public function getAllowedFileExtensionsString()
    {
        return $this->getConfig(self::CONFIG_XML_PATH_ALLOWED_EXTENSION);
    }

    /**
     *
     * @return string
     */
    public function getNewStatusTicket()
    {

        return $this->getConfig(self::CONFIG_XML_PATH_NEW_STATUS_TICKET);
    }

        /**
     *
     * @return string
     */
    public function getCloseStatusTicket()
    {
        return $this->getConfig(self::CONFIG_XML_PATH_CLOSE_STATUS_TICKET);
    }

    /**
     *
     * @return array
     */
    public function getAllowedFileExtensions()
    {
        return explode(',', $this->getAllowedFileExtensionsString());
    }

    /**
     *
     * @param  string  $filename
     * @return boolean
     */
    public function isFileExtensionAllowed($filename)
    {
        $allowedExtensions = $this->getAllowedFileExtensions();

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $extension = strtolower($extension);

        return in_array($extension, $allowedExtensions);
    }

    /**
     *
     * @param  int $customerId
     * @return string
     */
    public function getCustomerName($customerId, $default = '')
    {
        $customer = $this->customerFactory->create()->load($customerId);
        $name = $customer->getName();

        return empty($name) ? $default : $name;
    }

    /**
     *
     * @param  int $userId
     * @return string
     */
    public function getAdminUsername($userId)
    {
        $user = $this->userFactory->create()->load($userId);
        return $user->getUsername();
    }

    public function isAutoCloseTicket()
    {
        return $this->isEnabled() && $this->getConfig(self::CONFIG_XML_PATH_AUTO_CLOSE_TICKET);
    }


    public function getAutoCloseAfterXDay()
    {
        return $this->getConfig(self::CONFIG_XML_PATH_AUTO_CLOSE_TICKET_DAYS);
    }

    public function getAutoCloseStatusSkip()
    {
        return $this->getConfig(self::CONFIG_XML_PATH_AUTO_CLOSE_TICKET_STATUS_SKIP);
    }

    

    /**
     *
     * @param  String $attributeName
     * @param  string $value
     * @param  string $previous
     * @return string
     */
    public function getComment($attributeName, $value, $previous)
    {

        $comment = '';
        $attributeName = __($attributeName);
        $value = __($value);
        if ($previous === null) {
            $comment = '%1 was set up %2';
            $comment = __($comment, $attributeName, $value);
        } elseif ($previous !== $value) {
            $comment = '%1 has been changed from %2 to %3';
            $previous = __($previous);
            $comment = __($comment, $attributeName, $previous, $value);
        }

        return $comment;
    }

    public function getTimeAgo($time)
    {
        $time = strtotime($time);
        $diff = time() - $time;
        $seconds = $diff;
        $minutes = round($diff / 60);
        $hours   = round($diff / 3600);
        $days    = round($diff / 86400);
        $weeks   = round($diff / 604800);
        $months  = round($diff / 2419200);
        $years   = round($diff / 29030400);
        //Seconds
        if ($seconds <= 30) {
            $timeLabel = __('Just now');
        } else if ($seconds <= 60) {
            $timeLabel = __('%1 seconds ago', $seconds);
        //Minutes
        } elseif ($minutes <= 60) {
            if ($minutes == 1) {
                $timeLabel = __('one minute ago');
            } else {
                $timeLabel = __('%1 minutes ago', $minutes);
            }
        //Hours
        } elseif ($hours <= 24) {
            if ($hours == 1) {
                $timeLabel = __('one hour ago');
            } else {
                $timeLabel = __('%1 hours ago', $hours);
            }
        //Days
        } elseif ($days <= 7) {
            if ($days == 1) {
                $timeLabel = __('one day ago');
            } else {
                $timeLabel = __('%1 days ago', $days);
            }
        //Weeks
        } elseif ($weeks <= 4) {
            if ($weeks == 1) {
                $timeLabel = __('one week ago');
            } else {
                $timeLabel = __('%1 weeks ago', $weeks);
            }
        //Months
        } elseif ($months <= 12) {
            if ($months == 1) {
                $timeLabel = __('one month ago');
            } else {
                $timeLabel = __('%1 months ago', $months);
            }
        //Years
        } else {
            if ($years == 1) {
                $timeLabel = __('one year ago');
            } else {
                $timeLabel = __('%1 years ago', $years);
            }
        }
        return $timeLabel;
    }
}
