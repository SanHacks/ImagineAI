<?php

namespace Gundo\Imagine\Controller\Adminhtml\Imagine;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * New action Imagine controller.
 */
class NewAction extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Gundo_Imagine::management';

    /**
     * Create new Imagine action.
     *
     * @return Page|ResultInterface
     */
    public function execute(): ResultInterface|Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Gundo_Imagine::management');
        $resultPage->getConfig()->getTitle()->prepend(__('New Imagine'));

        return $resultPage;
    }
}
