<?php declare(strict_types=1);

namespace Gundo\Imagine\Model;

use Magento\Framework\Exception\InputException;
use Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface;
use Magento\ReCaptchaUi\Model\ValidationConfigResolverInterface;
use Magento\ReCaptchaValidationApi\Api\Data\ValidationConfigInterface;
use Magento\ReCaptchaWebapiApi\Api\Data\EndpointInterface;

class WebapiConfigProvider
{
    /**
     * @var IsCaptchaEnabledInterface
     */
    private $isEnabled;

    /**
     * @var ValidationConfigResolverInterface
     */
    private $configResolver;

    /**
     * @param IsCaptchaEnabledInterface $isEnabled
     * @param ValidationConfigResolverInterface $configResolver
     */
    public function __construct(
        IsCaptchaEnabledInterface         $isEnabled,
        ValidationConfigResolverInterface $configResolver
    ) {
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
        if ($this->isEnabled->isCaptchaEnabledFor('imagine')) {
            return $this->configResolver->get('imagine');
        }

        return null;
    }
}
