<?php

namespace Gundo\Imagine\Block;

use Exception;
use Gundo\Imagine\Helper\GenerateImage;
use Magento\Framework\View\Element\Template;

class Image extends Template
{
    /**
     * @var GenerateImage
     */
    protected GenerateImage $generateImage;

    /**
     * @param Template\Context $context
     * @param GenerateImage $generateImage
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        GenerateImage    $generateImage,
        array            $data = []
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
        return $this->generateImage->getSingleImageUrl($prompt);
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
