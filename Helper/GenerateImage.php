<?php

namespace Gundo\Imagine\Helper;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\StateException;
use Gundo\Imagine\Logger\Logger;

/**
 * Class GenerateImage
 * @package Gundo\Imagine\Helper
 */
class GenerateImage
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @var array|string[]
     */
    protected array $headers;

    /**
     * @var ProductRepositoryInterface
     */
    protected ProductRepositoryInterface $productRepository;

    /**
     * @var Data $configHelpers
     */
    private Data $configHelpers;

    /**
     * @var Logger
     */
    private Logger $logger;


    /**
     * @param Client $client
     * @param ProductRepositoryInterface $productRepository
     * @param Data $configHelper
     * @param Data $configHelpers
     */
    /**
     * @param Client $client
     * @param ProductRepositoryInterface $productRepository
     * @param Data $configHelper
     * @param Data $configHelpers
     * @param Logger $logger
     */
    public function __construct(
        Client                     $client,
        ProductRepositoryInterface $productRepository,
        Data                       $configHelper,
        Data                       $configHelpers,
        Logger                     $logger
    )
    {
        $this->client = $client;
        $this->productRepository = $productRepository;
        $apiKey = $configHelper->getApiKey();
        $this->headers = ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $apiKey];
        $this->configHelpers = $configHelpers;
        $this->logger = $logger;
    }

    /**
     * Fetch Product From OpenAI As Generation
     * @throws Exception
     */
    public function getSingleImageUrl($prompt)
    {

        if (!$prompt) {
            throw new Exception('Prompt is required');
        }

        $fineTunePhrase = $this->configHelpers->getModelFineTune();
        if (!$fineTunePhrase) {
            $fineTunePhrase = '';
        }

        /** Quality Options
         * 1024x1024 //Highest Quality
         *       512x512
         *      256x256
         * */
        $body = json_encode(['prompt' => $prompt . $fineTunePhrase, 'n' => 1, 'size' => '512x512']);
        $this->logger->info('Request Body: ' . $body);
        $request = new Request('POST', 'https://api.openai.com/v1/images/generations', $this->headers, $body);

        try {
            $response = $this->client->send($request);
            $this->logger->info('Response: ' . $response->getBody());
            $responseData = json_decode($response->getBody(), true);
            //Return Image or nothing
            $imageURl = $responseData['date'][0]['url'] ?? null;
            if ($imageURl) {
                $this->logger->info('Image URL: ' . $imageURl);
            }
            return $responseData['data'][0]['url'] ?? null;
        } catch (GuzzleException $e) {
            $this->logger->error('Error: ' . $e->getMessage());
            return null;
        }
    }
}
