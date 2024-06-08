<?php

namespace Gundo\Imagine\Model;

use Gundo\Imagine\Model\ResourceModel\Image as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Image extends AbstractModel
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
    protected function _construct(): void
    {
        $this->_init(ResourceModel::class);
    }
}
