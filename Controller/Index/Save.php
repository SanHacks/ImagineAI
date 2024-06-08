<?php declare(strict_types=1);

namespace Gundo\Imagine\Controller\Index;

use Exception;
use Gundo\Imagine\Helper\GenerateImageHelper;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Save extends Action
{
    /**
     * @var GenerateImageHelper
     */
    protected GenerateImageHelper $generateImage;

    /**
     * @param Context $context
     * @param GenerateImageHelper $generateImage
     */
    public function __construct(
        Context       $context,
        GenerateImageHelper $generateImage
    ) {
        $this->generateImage = $generateImage;
        parent::__construct($context);
    }

    /**
     * @throws Exception
     */
    public function execute(): Page|ResultInterface|ResponseInterface
    {
        $postData = $this->getRequest()->getPostValue();

        if ($postData && isset($postData['prompt'])) {
            $prompt = $postData['prompt'];
            $generatedImageUrl = $this->generateImage->generateSingleImage($prompt);

            // Render the template with the generated image URL
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $block = $resultPage->getLayout()->getBlock('content');
            if ($block) {
                $block->setData('generatedImageUrl', $generatedImageUrl);
            }

            return $resultPage;
        }

        // If no valid POST data is received, redirect back to the referring page or any other desired action.
        return $this->_redirect('*/*/'); // Redirect back to the same controller action.
    }
}
