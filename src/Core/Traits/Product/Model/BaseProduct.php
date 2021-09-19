<?php

namespace Funnelnek\Core\Traits\Product\Model;

use Funnelnek\Core\Data\Attribute\Definition\BOOLEAN;
use Funnelnek\Core\Data\Attribute\Definition\DECIMAL;
use Funnelnek\Core\Data\Attribute\Definition\ENUM;
use Funnelnek\Core\Data\Attribute\Definition\FLOATING;
use Funnelnek\Core\Data\Attribute\Definition\FOREIGN_KEY;
use Funnelnek\Core\Data\Attribute\Definition\REQUIRED;
use Funnelnek\Core\Data\Attribute\Definition\UNIQUE;
use Funnelnek\Core\Data\Attribute\Definition\VARCHAR;

trait BaseProduct
{
    #[REQUIRED]
    #[UNIQUE]
    #[VARCHAR(length: 15)]
    public string $sku;

    #[BOOLEAN]
    public bool $enabled = false;

    #[REQUIRED]
    #[UNIQUE]
    #[VARCHAR(length: 150)]
    public string $title;

    #[REQUIRED]
    #[UNIQUE]
    #[VARCHAR(length: 150)]
    public string $name;

    #[REQUIRED]
    #[ENUM(options: ProductType::class)]
    public string $type;

    #[REQUIRED]
    #[DECIMAL(digits: 9, precision: 2)]
    public float $price;

    #[FOREIGN_KEY(repository: 'brands', field: 'name')]
    public string $brand;

    #[BOOLEAN]
    public bool $isVariant = false;

    #[FLOATING(digits: 3, precision: 2)]
    public float $rating = 0.0;

    #[VARCHAR(length: 100)]
    public string $manufacturer;
}
