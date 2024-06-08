<?php declare(strict_types=1);

namespace Gundo\Imagine\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Gundo\Imagine\Helper\Data as Config;

class Index implements HttpGetActionInterface
{
    public PageFactory $resultPageFactory;

    private Config $config;

    private Session $customerSession;

    /**
     * @param PageFactory $resultPageFactory
     * @param Config $config
     * @param Context $context
     * @param Session $customerSession
     */
    public function __construct(
        PageFactory $resultPageFactory,
        Config      $config,
        Context     $context,
        Session     $customerSession
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->config = $config;
        $this->customerSession = $customerSession;
    }

    /**
     * Prints the information
     */
    public function execute(): Page|ResultInterface|ResponseInterface
    {
        if ($this->config->isImagineEnabled() === true && $this->config->getApiKey() !== null) {
            if ($this->customerSession->isLoggedIn()) {
                $resultPage = $this->imagineResultPage();
            } else {
                if (!$this->customerSession->isLoggedIn() && $this->config->isGuestAllowed() === true) {
                    $resultPage = $this->imagineResultPage();
                } else {
                    $resultPage = $this->resultPageFactory->create();
                    $resultPage->getConfig()->getTitle()->set(__('Please Login'));
                }
            }
        } else {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->set(__('Imagine is not enabled'));
            $resultPage->getLayout()
                ->createBlock('Magento\Framework\View\Element\Template')
                ->setTemplate('Gundo_Imagine::error.phtml');
        }

        return $resultPage;
    }

    /**
     * @return Page
     */
    public function imagineResultPage(): Page
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Imagine'));
        return $resultPage;
    }

}
