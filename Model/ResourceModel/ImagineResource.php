<?php

namespace Gundo\Imagine\Model\ResourceModel;

use Gundo\Imagine\Api\Data\ImagineInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ImagineResource extends AbstractDb
{
    /**
     * @var string
     */
    protected string $_eventPrefix = 'imagine_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('imagine', ImagineInterface::IMAGINE_ID);
        $this->_useIsObjectNew = true;
    }
}
