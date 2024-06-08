<?php

namespace Gundo\Imagine\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Image extends AbstractDb
{
    /**
     * @var string
     */
    protected string $_eventPrefix = 'imagine_resource_model';

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('imagine', 'imagine_id');
        $this->_useIsObjectNew = true;
    }
}
