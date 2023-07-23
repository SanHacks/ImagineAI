<?php

namespace Gundo\Imagine\Model\ResourceModel\ImagineModel;

use Gundo\Imagine\Model\ImagineModel;
use Gundo\Imagine\Model\ResourceModel\ImagineResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class ImagineCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'imagine_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(ImagineModel::class, ImagineResource::class);
    }
}
