<?php

namespace Gundo\Imagine\Api;

use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Delete Imagine by id Command.
 *
 * @api
 */
interface DeleteImagineByIdInterface
{
    /**
     * Delete Imagine.
     * @param int $entityId
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void;
}
