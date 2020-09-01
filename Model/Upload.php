<?php
namespace MagePrakash\Helpdesk\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\ScopeInterface;

class Upload
{
    const HELPDESK_ATTACHMENT_PATH = "Mageprakash/helpdesk/";
    protected $uploaderFactory;
    protected $configHelper;
    protected $fileInfo;
    protected $_mediaDirectory;

    /**
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
     */
    public function __construct(
        \MagePrakash\Helpdesk\Helper\Config $configHelper,        
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->configHelper = $configHelper;       
        $this->uploaderFactory = $uploaderFactory;
    }

    /**
     * @param  array $uploadData
     * @return array
     */
    public function uploadFileAndGetInfo($uploadData)
    {

        $target = $this->_mediaDirectory->getAbsolutePath(self::HELPDESK_ATTACHMENT_PATH);
        //$varDirectoryPath = $this->fileInfo->getBaseDir();

        $allowedExtensions = $this->configHelper->getAllowedFileExtensions();


        $result = $this->uploaderFactory
            ->create(['fileId' => $uploadData])
            // ->setAllowCreateFolders(true)
            ->setAllowedExtensions($allowedExtensions)
            ->setAllowRenameFiles(true)
            ->setFilesDispersion(true)
            ->save($target);
        
        unset($result['path']);
        // $result['url'] = $this->fileInfo->getUrl($result['file']);
        // $result['stat'] = $this->fileInfo->getStat($result['file'])['ctime'];

        return $result;
    }
}
