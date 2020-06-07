## Installation

`composer require dndeus/module-logger`

## Magento installation

```
bin/magento module:enable Dndeus_Logger

bin/magento setup:upgrade
```

## Usage

```
$logger = new Logger();

$data = ['name' => 'Test'];

$logger->forType('products') // this must be snakecase sting or single word
       ->success($data,'Processing the given data was successful');

$logger->forType('products_data') // this must be snakecase sting or single word
       ->failed($data,'Processing the given data failed for whatever reason');
```

## View the logs in your magento admin area
