<?php

namespace Gundo\Imagine\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class AvailableModels implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        $models = array(
            'gpt3' => 'Dall-E 2(default)',
            'gpt35' => 'DaVinci 1.3',
            'gpt4' => 'Dall-E 1',
        );

        $options = [];
        foreach ($models as $value => $label) {
            $options[] = ['value' => $value, 'label' => $label];
        }

        return $options;
    }
}
