<?php declare(strict_types=1);

namespace Gundo\Imagine\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * @param $storeId
     * @return bool
     */
    public function isImagineEnabled($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            'imagine/general/enabled',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function getApiKey($storeId = null): mixed
    {
        return $this->scopeConfig->getValue(
            'imagine/general/api_key',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function getModelFineTune($storeId = null): mixed
    {
        return $this->scopeConfig->getValue(
            'imagine/general/fine_tune',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function getApiSecret($storeId = null): mixed
    {
        return $this->scopeConfig->getValue(
            'imagine/general/api_secret',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param $storeId
     * @return bool
     */
    public function isGuestAllowed($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            'imagine/general/allow_guests',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param $storeId
     * @return array
     */
    public function getCustomerGroups($storeId = null): array
    {
        $customerGroups = $this->scopeConfig->getValue(
            'imagine/general/customer_groups',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        return explode(',', $customerGroups);
    }

    /**
     * @param $storeId
     * @return bool
     */
    public function isSaveToCustomerAccount($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            'imagine/general/save_to_customer_account',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param $storeId
     * @return bool
     */
    public function isAllowedToSave($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            'imagine/general/save_to_database',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @return string
     */
    public function getImageConfig(): string
    {
        return $this->scopeConfig
            ->getValue(
                'imagine/general/image_quality'
            );
    }
}
