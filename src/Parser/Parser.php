<?php

namespace App\Parser;

use App\Parser\Service\CsvService;
use App\Parser\Service\SiteCommunicationService;

class Parser
{
    private $siteCommunicationService;
    private $csvService;

    public function __construct()
    {
        $this->siteCommunicationService = new SiteCommunicationService();
        $this->csvService = new CsvService();
    }

    public function parseAndSaveData()
    {
        $this->csvService->clearAndCreateCsvFile();

        $currentPage = 1;
        $productsIds = $this->siteCommunicationService->getProductsIdsFromPage($currentPage);
        while (!empty($productsIds)) {
            foreach ($productsIds as $productId) {
                $product = $this->siteCommunicationService->getProduct($productId);
                $this->csvService->saveProduct($product);
            }

            $currentPage++;
            $productsIds = $this->siteCommunicationService->getProductsIdsFromPage($currentPage);
        };
    }
}
