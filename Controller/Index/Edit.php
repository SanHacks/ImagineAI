<?php

namespace Gundo\Imagine\Controller\Index;

use Gundo\Imagine\Helper\GenerateImage;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{

    /**
     * @var GenerateImage
     */
    protected GenerateImage $generateImage;

    /**
     * @param Context $context
     * @param GenerateImage $generateImage
     */
    public function __construct(Context $context, GenerateImage $generateImage)
    {
        $this->generateImage = $generateImage;
        parent::__construct($context);
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            print_r($postData['prompt']);
            $prompt = 'Sky People';
            print_r($this->generateImage->getSingleImageUrl($prompt));
        }

        // Process the POST data as needed
        // Example: Save data to database or perform other actions
        print_r($postData);

        // Return a response (optional)
        $response = ['status' => 'success', 'message' => 'Data saved successfully'];
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($response);
        return $resultJson;
    }
}
