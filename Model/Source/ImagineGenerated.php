<?php

namespace Gundo\Imagine\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class ImagineGenerated extends AbstractSource
{
    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        return [];
    }
}
