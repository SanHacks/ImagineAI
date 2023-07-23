<?php

namespace Gundo\Imagine\Command\Imagine;

use Exception;
use Gundo\Imagine\Api\Data\ImagineInterface;
use Gundo\Imagine\Api\DeleteImagineByIdInterface;
use Gundo\Imagine\Model\ImagineModel;
use Gundo\Imagine\Model\ResourceModel\ImagineResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete Imagine by id Command.
 */
class DeleteByIdCommand implements DeleteImagineByIdInterface
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
    public function execute(int $entityId): void
    {
        try {
            /** @var ImagineModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, ImagineInterface::IMAGINE_ID);

            if (!$model->getData(ImagineInterface::IMAGINE_ID)) {
                throw new NoSuchEntityException(
                    __('Could not find Imagine with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete Imagine. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete Imagine.'));
        }
    }
}
