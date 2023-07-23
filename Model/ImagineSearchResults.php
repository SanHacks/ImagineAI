<?php

namespace Gundo\Imagine\Model;

use Gundo\Imagine\Api\Data\ImagineSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Imagine entity search results implementation.
 */
class ImagineSearchResults extends SearchResults implements ImagineSearchResultsInterface
{
    /**
     * Set items list.
     *
     * @param array $items
     *
     * @return ImagineSearchResultsInterface
     */
    public function setItems(array $items): ImagineSearchResultsInterface
    {
        return parent::setItems($items);
    }

    /**
     * Get items list.
     *
     * @return array
     */
    public function getItems(): array
    {
        return parent::getItems();
    }
}
