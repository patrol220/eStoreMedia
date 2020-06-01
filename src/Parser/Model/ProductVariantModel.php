<?php

namespace App\Parser\Model;

class ProductVariantModel {

    /** @var string */
    private $price;

    /** @var string|null */
    private $priceOld;

    /** @var string */
    private $name;

    /**
     * ProductVariantModel constructor.
     * @param string $name
     * @param string $price
     * @param string|null $priceOld
     */
    public function __construct(string $name, string $price, ?string $priceOld)
    {
        $this->name = $name;
        $this->price = $price;
        $this->priceOld = $priceOld;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getPriceOld(): ?string
    {
        return $this->priceOld;
    }
}
