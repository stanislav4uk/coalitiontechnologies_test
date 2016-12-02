<?php

namespace App\Repositories;

use App\Models\Product;
use App\Storages\JsonStorage;
use Illuminate\Support\Collection;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository
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
     * @param $id
     * @return Product
     */
    public function find($id)
    {
        return $this->all()->get($id);
    }

    /**
     * Returns all products created before
     *
     * @return Collection
     */
    public function all()
    {
        $collection = new Collection();

        foreach ($this->storage->all() as $item) {
            $product = new Product($item);
            $product->setAttribute($product->getKeyName(), $item[$product->getKeyName()]);
            $product->setCreatedAt($item["created_at"]);
            $collection->put($product->getKey(), $product);
        }

        return $collection;
    }
}