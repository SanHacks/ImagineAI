<?php

namespace Gundo\Imagine\Block\Form\Imagine;

use Gundo\Imagine\Api\Data\ImagineInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->getImagineId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this imagine?'),
                $this->getUrl(
                    '*/*/delete',
                    [ImagineInterface::IMAGINE_ID => $this->getImagineId()]
                )
            ),
            [],
            20
        );
    }
}
