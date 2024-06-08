<?php declare(strict_types=1);

namespace Gundo\Imagine\Model;

use Magento\Framework\Exception\InputException;
use Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface;
use Magento\ReCaptchaUi\Model\ValidationConfigResolverInterface;
use Magento\ReCaptchaValidationApi\Api\Data\ValidationConfigInterface;
use Magento\ReCaptchaWebapiApi\Api\Data\EndpointInterface;

/**
 * @package Gundo/Imagine
 */
class WebapiConfigProvider
{
    /**
     * Captcha id from config.
     */
    private const CAPTCHA_ID = 'imagine';

    /**
     * @var IsCaptchaEnabledInterface
     */
    private IsCaptchaEnabledInterface $isEnabled;

    /**
     * @var ValidationConfigResolverInterface
     */
    private ValidationConfigResolverInterface $configResolver;

    /**
     * @param IsCaptchaEnabledInterface $isEnabled
     * @param ValidationConfigResolverInterface $configResolver
     */
    public function __construct(IsCaptchaEnabledInterface $isEnabled, ValidationConfigResolverInterface $configResolver)
    {
        $this->isEnabled = $isEnabled;
        $this->configResolver = $configResolver;
    }


    /**
     * @param EndpointInterface $endpoint
     * @return ValidationConfigInterface|null
     * @throws InputException
     */
    public function getConfigFor(EndpointInterface $endpoint): ?ValidationConfigInterface
    {
        if ($this->isEnabled->isCaptchaEnabledFor(self::CAPTCHA_ID)) {
            return $this->configResolver->get(self::CAPTCHA_ID);
        }

        return null;
    }
}

