<?php

namespace Gundo\Imagine\Model\Data;

use Gundo\Imagine\Api\Data\ImagineInterface;
use Magento\Framework\DataObject;

class ImagineData extends DataObject implements ImagineInterface
{
    /**
     * Getter for ImagineId.
     *
     * @return int|null
     */
    public function getImagineId(): ?int
    {
        return $this->getData(self::IMAGINE_ID) === null ? null : (int)$this->getData(self::IMAGINE_ID);
    }

    /**
     * Setter for ImagineId.
     *
     * @param int|null $imagineId
     *
     * @return void
     */
    public function setImagineId(?int $imagineId): void
    {
        $this->setData(self::IMAGINE_ID, $imagineId);
    }

    /**
     * Getter for ProductId.
     *
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->getData(self::PRODUCT_ID) === null ? null : (int)$this->getData(self::PRODUCT_ID);
    }

    /**
     * Setter for ProductId.
     *
     * @param int|null $productId
     *
     * @return void
     */
    public function setProductId(?int $productId): void
    {
        $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Getter for Category.
     *
     * @return int|null
     */
    public function getCategory(): ?int
    {
        return $this->getData(self::CATEGORY) === null ? null : (int)$this->getData(self::CATEGORY);
    }

    /**
     * Setter for Category.
     *
     * @param int|null $category
     *
     * @return void
     */
    public function setCategory(?int $category): void
    {
        $this->setData(self::CATEGORY, $category);
    }

    /**
     * Getter for Url.
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->getData(self::URL);
    }

    /**
     * Setter for Url.
     *
     * @param string|null $url
     *
     * @return void
     */
    public function setUrl(?string $url): void
    {
        $this->setData(self::URL, $url);
    }

    /**
     * Getter for CreateAt.
     *
     * @return string|null
     */
    public function getCreateAt(): ?string
    {
        return $this->getData(self::CREATE_AT);
    }

    /**
     * Setter for CreateAt.
     *
     * @param string|null $createAt
     *
     * @return void
     */
    public function setCreateAt(?string $createAt): void
    {
        $this->setData(self::CREATE_AT, $createAt);
    }
}
