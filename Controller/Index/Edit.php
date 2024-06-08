<?php declare(strict_types=1);

namespace Gundo\Imagine\Controller\Index;

use Exception;
use Gundo\Imagine\Helper\GenerateImageHelper;
use Gundo\Imagine\Logger\Logger;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    /**
     * @var GenerateImageHelper
     */
    protected $generateImage;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Context $context
     * @param GenerateImageHelper $generateImage
     * @param Logger $logger
     */
    public function __construct(
        Context             $context,
        GenerateImageHelper $generateImage,
        Logger              $logger
    ) {
        $this->generateImage = $generateImage;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @throws Exception
     */
    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            $this->logger->info('Post Data: ' . json_encode($postData));
            $prompt = 'Sky People';
            $this->logger->info('Prompt: ' . $prompt);
        }

        $response = ['status' => 'success', 'message' => 'Data saved successfully'];
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($response);
        return $resultJson;
    }
}
