<?php

namespace Gundo\Imagine\Api\Data;

interface ImagineInterface
{
    /**
     * String constants for property names
     */
    public const IMAGINE_ID = "imagine_id";
    public const PRODUCT_ID = "product_id";
    public const CATEGORY = "category";
    public const URL = "url";
    public const CREATE_AT = "create_at";

    /**
     * Getter for ImagineId.
     *
     * @return int|null
     */
    public function getImagineId(): ?int;

    /**
     * Setter for ImagineId.
     *
     * @param int|null $imagineId
     *
     * @return void
     */
    public function setImagineId(?int $imagineId): void;

    /**
     * Getter for ProductId.
     *
     * @return int|null
     */
    public function getProductId(): ?int;

    /**
     * Setter for ProductId.
     *
     * @param int|null $productId
     *
     * @return void
     */
    public function setProductId(?int $productId): void;

    /**
     * Getter for Category.
     *
     * @return int|null
     */
    public function getCategory(): ?int;

    /**
     * Setter for Category.
     *
     * @param int|null $category
     *
     * @return void
     */
    public function setCategory(?int $category): void;

    /**
     * Getter for Url.
     *
     * @return string|null
     */
    public function getUrl(): ?string;

    /**
     * Setter for Url.
     *
     * @param string|null $url
     *
     * @return void
     */
    public function setUrl(?string $url): void;

    /**
     * Getter for CreateAt.
     *
     * @return string|null
     */
    public function getCreateAt(): ?string;

    /**
     * Setter for CreateAt.
     *
     * @param string|null $createAt
     *
     * @return void
     */
    public function setCreateAt(?string $createAt): void;
}
