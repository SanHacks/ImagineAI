<?php declare(strict_types=1);

namespace Gundo\Imagine\Block;

use Magento\Framework\View\Element\Template;

/**
 * @Index Block
 * @package Gundo\Imagine
 */
class Index extends Template
{
    /**
     * @return Index
     */
    public function _prepareLayout(): Index
    {
        $this->pageConfig->getTitle()->set(__('Imagine'));

        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    public function getFormAction(): string
    {
        return $this->getUrl('Imagine/index/save', ['_secure' => true]);
    }

    /**
     * @param string $field
     * @return mixed
     */
    public function getFormData(string $field): mixed
    {
        return $this->getRequest()->getParam('prompt');
    }
}
