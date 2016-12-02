<?php

namespace App\Managers;

use App\Models\Product;
use App\Storages\JsonStorage;

/**
 * Class ProductManager
 * @package App\Managers
 */
class ProductManager
{
    /**
     * @var JsonStorage
     */
    private $storage;

    /**
     * @param JsonStorage $storage
     */
    public function __construct(JsonStorage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param Product $product
     * @return int
     */
    public function save(Product $product)
    {
        $result = $this->storage->save($product->getAttributes());

        // Set ID for the product
        $product->setAttribute($product->getKeyName(), $result);

        return $product;
    }
}