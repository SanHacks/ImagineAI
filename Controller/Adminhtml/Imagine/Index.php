<?php

namespace Gundo\Imagine\Controller\Adminhtml\Imagine;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Imagine backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    public const ADMIN_RESOURCE = 'Gundo_Imagine::management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute(): ResultInterface|ResponseInterface
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Gundo_Imagine::management');
        $resultPage->addBreadcrumb(__('Imagine'), __('Imagine'));
        $resultPage->addBreadcrumb(__('Manage Imagines'), __('Manage Imagines'));
        $resultPage->getConfig()->getTitle()->prepend(__('Imagine List'));

        return $resultPage;
    }
}
