<?php

namespace GOG\Website\Shopping;

use Ramsey\Uuid\UuidInterface;

class Cart
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var array
     */
    private $products = [];

    /**
     * @param UuidInterface $id
     */
    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    /**
     * @param $productId
     */
    public function add($productId)
    {
        $this->products[] = $productId;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->products);
    }

    /**
     * @param $productId
     * @return bool
     */
    public function exists($productId)
    {
        return array_search($productId, $this->products) !== false;
    }
}