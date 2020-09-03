<?php
namespace MagePrakash\Helpdesk\Observer;

abstract class AbstractNotification implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Get extension configuration helper
     * @var \Swissup\Helpdesk\Helper\Config
     */
    protected $configHelper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     *
     * @var string
     */
    protected $mailMessageId;
    protected $backendUrl;
    /**
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Swissup\Helpdesk\Helper\Config $configHelper
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \MagePrakash\Helpdesk\Helper\Config $configHelper,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager = $storeManager;
        $this->configHelper = $configHelper;
        $this->backendUrl = $backendUrl;
        $this->logger = $logger;
    }

    /**
     * @param  array $from
     * @param  array $to
     * @param  int|string $templateId
     * @param  array $vars
     * @param  \Magento\Store\Api\Data\StoreInterface $store
     * @param  string $area
     * @return Magento\Framework\Mail\MessageInterface|boolean
     */
    protected function sendEmail(
        $from,
        $to,
        $templateId,
        $vars,
        $store,
        $area = \Magento\Framework\App\Area::AREA_FRONTEND,
        $headers = []
    ) {
       
        try {
            $this->inlineTranslation->suspend();

            $mime = new \Zend\Mime\Mime();
            $boundary = $mime->boundary();
            $vars['boundary'] = $boundary;

            $this->transportBuilder
                ->setTemplateIdentifier($templateId)
                ->setTemplateOptions([
                    'area' => $area,
                    'store' => $store->getId()
                ])
                ->setTemplateVars($vars)
                ->setFrom($from)
                ->addTo("prakash.patel@krishtechnolabs.com", $to['name']);
            $transport = $this->transportBuilder->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Magento\Framework\Exception\MailException $e) {
            $this->logger->error($e->getMessage());
            return false;
        }

        //return $mailMessage;
    }

    /**
     *
     * @param  string $body
     * @param  string $boundary
     * @return array|bool
     */
    private function splitBody($body, $boundary)
    {
        if (false === strpos($body, '<!-- ' . $boundary)) {
            return false;
        }

        $text = substr(
            $body,
            strpos($body, '<!-- ' . $boundary),
            strpos($body, $boundary . ' -->')
        );
        $html = str_replace($text, '', $body);
        $text = str_replace(['<!-- ' . $boundary, $boundary . ' -->'], '', $text);

        return [
            'text' => $text,
            'html' => $html
        ];
    }
}
