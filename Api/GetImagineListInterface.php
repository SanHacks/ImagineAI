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
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return ImagineSearchResultsInterface
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): ImagineSearchResultsInterface;
}
