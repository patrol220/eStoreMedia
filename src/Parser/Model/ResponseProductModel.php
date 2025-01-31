<?php

namespace App\Parser\Model;

class ResponseProductModel
{
    /** @var string */
    private $name;

    /** @var string */
    private $productUrl;

    /** @var string */
    private $photoUrl;

    /** @var string */
    private $price;

    /** @var int */
    private $ratesCount;

    /** @var int */
    private $starsCount;

    /** @var string */
    private $priceOld;

    /** @var string */
    private $productCode;

    /** @var ProductVariantModel[] */
    private $productVariants;

    /**
     * ResponseProductModel constructor.
     * @param string $name
     * @param string $productUrl
     * @param string $photoUrl
     * @param string $price
     * @param int $ratesCount
     * @param int $starsCount
     * @param string $priceOld
     * @param string $productCode
     * @param ProductVariantModel[] $productVariants
     */
    public function __construct(
        string $name,
        string $productUrl,
        string $photoUrl,
        string $price,
        int $ratesCount,
        int $starsCount,
        string $priceOld,
        string $productCode,
        array $productVariants
    ) {
        $this->name = $name;
        $this->productUrl = $productUrl;
        $this->photoUrl = $photoUrl;
        $this->price = $price;
        $this->ratesCount = $ratesCount;
        $this->starsCount = $starsCount;
        $this->priceOld = $priceOld;
        $this->productCode = $productCode;
        $this->productVariants = $productVariants;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProductUrl(): string
    {
        return $this->productUrl;
    }

    public function getPhotoUrl(): string
    {
        return $this->photoUrl;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getRatesCount(): int
    {
        return $this->ratesCount;
    }

    public function getStarsCount(): int
    {
        return $this->starsCount;
    }

    public function getPriceOld(): string
    {
        return $this->priceOld;
    }

    public function getProductCode(): string
    {
        return $this->productCode;
    }

    /**
     * @return ProductVariantModel[]
     */
    public function getProductVariants(): array
    {
        return $this->productVariants;
    }
}
