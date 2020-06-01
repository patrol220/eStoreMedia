# eStoreMedia parser

### Running project

#### requirements

* [composer](https://getcomposer.org/download/)
* PHP 7.2 with curl and json extensions

#### launching
Inside project directory:
* run ``composer install``
* start server ``php -S localhost:8000``

#### scripts

* run ``php parser.php`` to parse products and save them into csv file which should be available in data/products-data.csv
* go to ``http://localhost:8000/products.php`` to display all products from csv file
* single product page will be available at ``http://localhost:8000/product.php?id={productId}``
