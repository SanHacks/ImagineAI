<?php

namespace Gundo\Imagine\Mapper;

use Gundo\Imagine\Api\Data\ImagineInterface;
use Gundo\Imagine\Api\Data\ImagineInterfaceFactory;
use Gundo\Imagine\Model\ImagineModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of Imagine entities to an array of data transfer objects.
 */
class ImagineDataMapper
{
    /**
     * @var ImagineInterfaceFactory
     */
    private ImagineInterfaceFactory $entityDtoFactory;

    /**
     * @param ImagineInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        ImagineInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|ImagineInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var ImagineModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var ImagineInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
