<?php

namespace Gundo\Imagine\Controller\Adminhtml\Imagine;

use Gundo\Imagine\Api\Data\ImagineInterface;
use Gundo\Imagine\Api\Data\ImagineInterfaceFactory;
use Gundo\Imagine\Api\SaveImagineInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save Imagine controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Gundo_Imagine::management';

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    /**
     * @var SaveImagineInterface
     */
    private SaveImagineInterface $saveCommand;

    /**
     * @var ImagineInterface
     */
    private ImagineInterface $entityDataFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveImagineInterface $saveCommand
     * @param ImagineInterfaceFactory $entityDataFactory
     */
    public function __construct(
        Context                 $context,
        DataPersistorInterface  $dataPersistor,
        SaveImagineInterface    $saveCommand,
        ImagineInterface $entityDataFactory
    )
    {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
    }

    /**
     * Save Imagine Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute(): ResultInterface|ResponseInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();

        try {
            /** @var ImagineInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($params['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The Imagine data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                ImagineInterface::IMAGINE_ID => $this->getRequest()->getParam(ImagineInterface::IMAGINE_ID)
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
