<?php

namespace Gundo\Imagine\Controller\Adminhtml\Imagine;

use Gundo\Imagine\Api\Data\ImagineInterface;
use Gundo\Imagine\Api\DeleteImagineByIdInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Delete Imagine controller.
 */
class Delete extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Gundo_Imagine::management';

    /**
     * @var DeleteImagineByIdInterface
     */
    private DeleteImagineByIdInterface $deleteByIdCommand;

    /**
     * @param Context $context
     * @param DeleteImagineByIdInterface $deleteByIdCommand
     */
    public function __construct(
        Context                    $context,
        DeleteImagineByIdInterface $deleteByIdCommand
    )
    {
        parent::__construct($context);
        $this->deleteByIdCommand = $deleteByIdCommand;
    }

    /**
     * Delete Imagine action.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var ResultInterface $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        $entityId = (int)$this->getRequest()->getParam(ImagineInterface::IMAGINE_ID);

        try {
            $this->deleteByIdCommand->execute($entityId);
            $this->messageManager->addSuccessMessage(__('You have successfully deleted Imagine entity'));
        } catch (CouldNotDeleteException|NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect;
    }
}
