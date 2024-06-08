<?php

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
