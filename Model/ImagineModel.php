<?php

namespace Gundo\Imagine\Model;

use Gundo\Imagine\Model\ResourceModel\ImagineResource;
use Magento\Framework\Model\AbstractModel;

class ImagineModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'imagine_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ImagineResource::class);
    }
}
