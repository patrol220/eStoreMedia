<?php

namespace App\Parser\Service;

use App\Parser\Model\ProductVariantModel;
use App\Parser\Model\ResponseProductModel;
use voku\helper\HtmlDomParser;

class SiteCommunicationService
{
    const BASE_URL = 'http://estoremedia.space/DataIT/';

    private $curlSession;

    public function __construct()
    {
        $this->curlSession = curl_init();
        curl_setopt($this->curlSession, CURLOPT_RETURNTRANSFER, true);
    }

    public function __destruct()
    {
        curl_close($this->curlSession);
    }

    public function getProductsIdsFromPage(int $page): array
    {
        $url = self::BASE_URL . 'index.php?page=' . $page;

        curl_setopt($this->curlSession, CURLOPT_URL, $url);
        $head = curl_exec($this->curlSession);

        return $this->parsePageResponse($head);
    }

    public function getProduct(int $id): ResponseProductModel
    {
        $url = self::BASE_URL . 'product.php?id=' . $id;

        curl_setopt($this->curlSession, CURLOPT_URL, $url);
        $head = curl_exec($this->curlSession);

        return $this->parseProductResponse($head, $url);
    }

    private function parsePageResponse(string $response): array
    {
        $dom = HtmlDomParser::str_get_html($response);

        $productsIds = [];

        $productsCards = $dom
            ->findMultiOrFalse('.container .row .col-lg-9 .row .col-lg-4');

        if ($productsCards === false) {
            return [];
        }

        foreach ($productsCards as $productCard) {
            $hrefAttribute = $productCard
                ->find('.card')
                ->findOne('a')
                ->getAttribute('href');

            $productsIds[] = filter_var($hrefAttribute, FILTER_SANITIZE_NUMBER_INT);
        }

        return $productsIds;
    }

    private function parseProductResponse(string $response, string $productUrl): ResponseProductModel
    {
        $dom = HtmlDomParser::str_get_html($response);
        $productBase = $dom->findOne('.container .row .col-lg-9');

        $name = $productBase->findOne('.mb-0 h3')->text();
        $photoUrl = $productBase->findOne('.row .col-12 .card img')->getAttribute('src');
        $price = $productBase->findOne('.price')->text();
        if (empty($price)) {
            $price = $productBase->findOne('.price-promo')->text();
        }

        $starsCount = 0;
        $ratesCount = 0;
        $rates = $productBase->findOne('.card-footer .text-muted')->text();
        $ratesValues = explode(';', $rates);

        foreach ($ratesValues as $value) {
            if ($value === '&#9733') {
                $starsCount++;
            } else {
                $ratesCount = filter_var(end($ratesValues), FILTER_SANITIZE_NUMBER_INT);
                break;
            }
        }

        $priceOld = $productBase->findOne('.price-old')->text();

        $jsonProductData = json_decode($productBase->findOne('.card .card-body script')->text(), true);
        $productData = $jsonProductData['products'];
        $productCode = $productData['code'];

        $variants = [];

        if (array_key_exists('variants', $productData)) {
            foreach ($productData['variants'] as $variantName => $variantData) {
                $variants[] = new ProductVariantModel($variantName, $variantData['price'], $variantData['price_old']);
            }
        }

        return new ResponseProductModel(
            $name,
            $productUrl,
            $photoUrl,
            $price,
            $ratesCount,
            $starsCount,
            $priceOld,
            $productCode,
            $variants
        );
    }
}
