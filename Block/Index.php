<?php

namespace Gundo\Imagine\Block;

use Gundo\LoyaltyProgramme\Block\ProgrammeForm;
use Magento\Framework\View\Element\Template;

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
     * @param $field
     * @return mixed
     */
    public function getFormData($field): mixed
    {
        return $this->getRequest()->getParam('prompt');
    }
}
