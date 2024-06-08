<?php

namespace Gundo\Imagine\Model\ResourceModel\Image;

use Gundo\Imagine\Model\Image as Model;
use Gundo\Imagine\Model\ResourceModel\Image as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'imagine_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct(): void
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
