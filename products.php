<?php

require __DIR__ . '/vendor/autoload.php';

$csvService = new \App\Parser\Service\CsvService();
$products = $csvService->getAllProductsFromCsv();

?>

<html lang="en">
<head>
    <title>Products list</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Url</th>
        <th>Photo Url</th>
        <th>Price</th>
        <th>Rates</th>
        <th>Stars</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td>
                <?php $productId = filter_var($product->getProductUrl(), FILTER_SANITIZE_NUMBER_INT) ?>
                <a href="/product.php?id=<?= $productId ?>">
                    <?= $product->getName(); ?>
                </a>
            </td>
            <td><?= $product->getProductUrl(); ?></td>
            <td><?= $product->getPhotoUrl(); ?></td>
            <td><?= $product->getPrice(); ?></td>
            <td><?= $product->getRatesCount(); ?></td>
            <td><?= $product->getStarsCount(); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
