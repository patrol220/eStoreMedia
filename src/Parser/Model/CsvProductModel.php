<?php

namespace App\Parser\Model;

class CsvProductModel
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

    /**
     * CsvProductModel constructor.
     * @param string $name
     * @param string $productUrl
     * @param string $photoUrl
     * @param string $price
     * @param int $ratesCount
     * @param int $starsCount
     */
    public function __construct(
        string $name,
        string $productUrl,
        string $photoUrl,
        string $price,
        int $ratesCount,
        int $starsCount
    ) {
        $this->name = $name;
        $this->productUrl = $productUrl;
        $this->photoUrl = $photoUrl;
        $this->price = $price;
        $this->ratesCount = $ratesCount;
        $this->starsCount = $starsCount;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getProductUrl(): string
    {
        return $this->productUrl;
    }

    /**
     * @return string
     */
    public function getPhotoUrl(): string
    {
        return $this->photoUrl;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getRatesCount(): int
    {
        return $this->ratesCount;
    }

    /**
     * @return int
     */
    public function getStarsCount(): int
    {
        return $this->starsCount;
    }
}
