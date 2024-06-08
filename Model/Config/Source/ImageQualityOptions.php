<?php declare(strict_types=1);

namespace Gundo\Imagine\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class ImageQualityOptions implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        $imageQualityOptions = [
            '256x256' => 'Low (256x256)',
            '512x512' => 'Medium (512x512)',
            '1024x1024' => 'High (1024x1024)'
        ];

        $options = [];
        foreach ($imageQualityOptions as $value => $label) {
            $options[] = ['value' => $value, 'label' => $label];
        }

        return $options;
    }
}
