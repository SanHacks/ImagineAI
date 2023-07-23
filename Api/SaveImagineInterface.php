<?php

namespace Gundo\Imagine\Api;

use Gundo\Imagine\Api\Data\ImagineInterface;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save Imagine Command.
 *
 * @api
 */
interface SaveImagineInterface
{
    /**
     * Save Imagine.
     * @param ImagineInterface $imagine
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(ImagineInterface $imagine): int;
}
