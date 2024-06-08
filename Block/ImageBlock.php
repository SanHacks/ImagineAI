<?php declare(strict_types=1);

namespace Gundo\Imagine\Block;

use Exception;
use Gundo\Imagine\Helper\GenerateImageHelper;
use Magento\Framework\View\Element\Template;

class ImageBlock extends Template
{
    /**
     * @var GenerateImageHelper
     */
    protected GenerateImageHelper $generateImage;

    /**
     * @param Template\Context $context
     * @param GenerateImageHelper $generateImage
     * @param array $data
     */
    public function __construct(
        Template\Context    $context,
        GenerateImageHelper $generateImage,
        array               $data = []
    )
    {
        $this->generateImage = $generateImage;
        parent::__construct($context, $data);
    }

    /**
     * Get the image URL generated based on the prompt.
     *
     * @return string
     * @throws Exception
     */
    public function getImageUrl(): string
    {
        $prompt = $this->getPrompt();
        return $this->generateImage->generateSingleImage($prompt);
    }

    /**
     * Get the prompt text from the request.
     *
     * @return string|null
     */
    public function getPrompt(): ?string
    {
        return $this->getRequest()->getPostValue('prompt');
    }
}
