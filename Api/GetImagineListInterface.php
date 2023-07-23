<?php

namespace Gundo\Imagine\Api;

use Gundo\Imagine\Api\Data\ImagineSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Get Imagine list by search criteria query.
 *
 * @api
 */
interface GetImagineListInterface
{
    /**
     * Get Imagine list by search criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Gundo\Imagine\Api\Data\ImagineSearchResultsInterface
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): ImagineSearchResultsInterface;
}
