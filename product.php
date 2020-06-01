<?php

require __DIR__ . '/vendor/autoload.php';

$productId = $_GET['id'];

$siteCommunicationService = new \App\Parser\Service\SiteCommunicationService();
$product = $siteCommunicationService->getProduct($productId);

?>

<html lang="en">
<head>
    <title>Product</title>
</head>
<body>
<table>
    <tbody>
    <tr>
        <td>Price</td>
        <td><?= $product->getPrice() ?></td>
    </tr>
    <?php if (!empty($product->getPriceOld())): ?>
        <tr>
            <td>Price old</td>
            <td><?= $product->getPriceOld() ?></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td>Photo URL</td>
        <td><?= $product->getPhotoUrl() ?></td>
    </tr>
    <tr>
        <td>Product code</td>
        <td><?= $product->getProductCode() ?></td>
    </tr>
    <tr>
        <td>Rates</td>
        <td><?= $product->getRatesCount() ?></td>
    </tr>
    <tr>
        <td>Stars</td>
        <td><?= $product->getStarsCount() ?></td>
    </tr>
    </tbody>
</table>

<?php if (!empty($product->getProductVariants())): ?>
    <h2>Variants</h2>
    <div>
        <ul>
            <?php foreach ($product->getProductVariants() as $variant): ?>
                <li>
                    <p><?= $product->getName() . " #" . $variant->getName() ?></p>

                    <p><?= $variant->getPrice() ?></p>

                    <?php if (!empty($variant->getPriceOld())): ?>
                        <del><?= $variant->getPriceOld() ?></del>
                    <?php endif ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

</body>
</html>
