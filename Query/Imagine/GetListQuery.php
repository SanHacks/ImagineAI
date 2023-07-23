<?php

namespace Gundo\Imagine\Query\Imagine;

use Gundo\Imagine\Api\Data\ImagineSearchResultsInterface;
use Gundo\Imagine\Api\GetImagineListInterface;
use Gundo\Imagine\Mapper\ImagineDataMapper;
use Gundo\Imagine\Model\ResourceModel\ImagineModel\ImagineCollection;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Get Imagine list by search criteria query.
 */
class GetListQuery implements GetImagineListInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var ImagineCollection
     */
    private ImagineCollection $entityCollectionFactory;

    /**
     * @var ImagineDataMapper
     */
    private ImagineDataMapper $entityDataMapper;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var ImagineSearchResultsInterface
     */
    private ImagineSearchResultsInterface $searchResultFactory;

    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ImagineCollection $entityCollectionFactory
     * @param ImagineDataMapper $entityDataMapper
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ImagineSearchResultsInterface $searchResultFactory
     */
    public function __construct(
        CollectionProcessorInterface  $collectionProcessor,
        ImagineCollection             $entityCollectionFactory,
        ImagineDataMapper             $entityDataMapper,
        SearchCriteriaBuilder         $searchCriteriaBuilder,
        ImagineSearchResultsInterface $searchResultFactory
    )
    {
        $this->collectionProcessor = $collectionProcessor;
        $this->entityCollectionFactory = $entityCollectionFactory;
        $this->entityDataMapper = $entityDataMapper;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): ImagineSearchResultsInterface
    {
        /** @var ImagineCollection $collection */
        $collection = $this->entityCollectionFactory->create();

        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $entityDataObjects = $this->entityDataMapper->map($collection);

        /** @var ImagineSearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($entityDataObjects);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
