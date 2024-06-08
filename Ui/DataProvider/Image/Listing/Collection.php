<?php

namespace Gundo\Imagine\Ui\DataProvider\Image\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * @return void
     */
    public function _initSelect(): void
    {
        $this->addFilterToMap('imagine_id', 'imagine.imagine_id');
//        $this->addFilterToMap('product_id', 'imagine.product_id');
        parent::_initSelect();
    }
}
