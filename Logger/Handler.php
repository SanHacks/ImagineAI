<?php declare(strict_types=1);
/**
 * This file is part of the Gundo Imagine module.
 *
 * Copyright © Gundo Sifhufhi. All rights reserved.
 * See Github_Sanhacks.txt for license details.
 *
 * @package Gundo\Imagine
 */

namespace Gundo\Imagine\Logger;

use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;
class Handler extends Base
{
    /**
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * @var string
     */
    protected $fileName = '/var/log/imagine.log';
}
