<?php declare(strict_types=1);

namespace Gundo\Imagine\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class AvailableModels implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        $models = [
            'gpt3' => 'Dall-E 2(default)',
            'gpt35' => 'DaVinci 1.3',
            'gpt4' => 'Dall-E 1',
            'claude' => 'Claude',
//            'ollama' => 'Ollama',
//            'dall-e' => 'Dall-E',
//            'davinci' => 'DaVinci',
//            'curie' => 'Curie',
//            'babbage' => 'Babbage',
//            'ada' => 'Ada',
//            'gpt3' => 'GPT-3',
        ];

        $options = [];
        foreach ($models as $value => $label) {
            $options[] = ['value' => $value, 'label' => $label];
        }

        return $options;
    }
}
