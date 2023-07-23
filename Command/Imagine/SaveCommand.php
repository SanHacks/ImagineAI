<?php

namespace Gundo\Imagine\Command\Imagine;

use Exception;
use Gundo\Imagine\Api\Data\ImagineInterface;
use Gundo\Imagine\Api\SaveImagineInterface;
use Gundo\Imagine\Model\ImagineModel;
use Gundo\Imagine\Model\ResourceModel\ImagineResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save Imagine Command.
 */
class SaveCommand implements SaveImagineInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var ImagineModel
     */
    private ImagineModel $modelFactory;

    /**
     * @var ImagineResource
     */
    private ImagineResource $resource;

    /**
     * @param LoggerInterface $logger
     * @param ImagineModel $modelFactory
     * @param ImagineResource $resource
     */
    public function __construct(
        LoggerInterface $logger,
        ImagineModel    $modelFactory,
        ImagineResource $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public function execute(ImagineInterface $imagine): int
    {
        try {
            /** @var ImagineModel $model */
            $model = $this->modelFactory->create();
            $model->addData($imagine->getData());
            $model->setHasDataChanges(true);

            if (!$model->getData(ImagineInterface::IMAGINE_ID)) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save Imagine. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save Imagine.'));
        }

        return (int)$model->getData(ImagineInterface::IMAGINE_ID);
    }
}
