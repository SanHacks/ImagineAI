<?php

namespace Gundo\Imagine\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Imagine entity search result.
 */
interface ImagineSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param ImagineInterface[] $items
     *
     * @return ImagineSearchResultsInterface
     */
    public function setItems(array $items): ImagineSearchResultsInterface;

    /**
     * Get items.
     *
     * @return ImagineInterface[]
     */
    public function getItems(): array;
}
