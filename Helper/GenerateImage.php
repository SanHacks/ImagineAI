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
     * @param Client $client
     * @param ProductRepositoryInterface $productRepository
     * @param Data $configHelper
     * @param Data $configHelpers
     */
    public function __construct(Client $client, ProductRepositoryInterface $productRepository, Data $configHelper, Data $configHelpers,)
    {
        $this->client = $client;
        $this->productRepository = $productRepository;

        $apiKey = $configHelper->getApiKey();
        $this->headers = ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $apiKey,];
        $this->configHelpers = $configHelpers;
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

        $request = new Request('POST', 'https://api.openai.com/v1/images/generations', $this->headers, $body);

        try {
            $response = $this->client->send($request);
            $responseData = json_decode($response->getBody(), true);
            //Return Image or nothing
            $imageURl = $responseData['date'][0]['url'] ?? null;
            if ($imageURl) {
                $this->generateAndSaveProduct($imageURl);
            }
            return $responseData['data'][0]['url'] ?? null;
        } catch (GuzzleException $e) {
            throw new Exception($e);
        }
    }

    /**
     * Fetch Product From OpenAI As Generated and save as a new product entity.
     *
     * @param $imageUrl
     * @return ProductInterface|null
     * @throws InputException
     * @throws StateException
     * @throws Exception
     */
    public function generateAndSaveProduct($imageUrl): ?ProductInterface
    {

        try {
            // Create a new product entity
            $product = ObjectManager::getInstance()->create(ProductInterface::class);
            $product->setSku('generated_product_' . time()); // Set a unique SKU for the product
            $product->setName('Generated Product'); // Set the product name
            $product->setDescription('Generated product description'); // Set the product description
            // Set other product attributes as needed...

            // Set the product image as the generated image URL
            $product->setImage($imageUrl);
            $product->setSmallImage($imageUrl);
            $product->setThumbnail($imageUrl);

            // Save the product
            return $this->productRepository->save($product);
        } catch (CouldNotSaveException $e) {
            throw new Exception($e);
        }
    }


}
