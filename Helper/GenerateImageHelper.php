<?php declare(strict_types=1);

namespace Gundo\Imagine\Helper;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Gundo\Imagine\Logger\Logger;

/**
 * Class GenerateImage
 */
class GenerateImageHelper
{
    const LIMIT = 1;

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
     * @var Data $configData
     */
    private Data $configData;

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @param Client $client
     * @param ProductRepositoryInterface $productRepository
     * @param Data $configHelper
     * @param Data $configData
     * @param Logger $logger
     */
    public function __construct(
        Client                     $client,
        ProductRepositoryInterface $productRepository,
        Data                       $configHelper,
        Data                       $configData,
        Logger                     $logger
    ) {
        $this->client = $client;
        $this->productRepository = $productRepository;
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $configHelper->getApiKey()
        ];
        $this->configData = $configData;
        $this->logger = $logger;
    }

    /**
     * Fetch Product From OpenAI As Generation
     * @throws Exception
     */
    public function generateSingleImage($prompt)
    {
        if (!$prompt) {
            return null;
        }

        $body = json_encode(
            [
                'prompt' => $prompt . $this->configData->getModelFineTune() ?? '',
                'n' => self::LIMIT,
                'size' => $this->getImageConfig() ?? '256x256'
            ]
        );

        $this->logger->info('Request Body: ' . $body);
        $request = new Request('POST', 'https://api.openai.com/v1/images/generations', $this->headers, $body);

        try {
            $response = $this->client->send($request);
            $this->logger->info('Response: ' . $response->getBody());
            $responseData = json_decode($response->getBody()->getContents(), true);

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

    /**
     * Get Image Config
     * @return string
     */
    public function getImageConfig(): string
    {
        return $this->configData->getImageConfig();
    }
}
