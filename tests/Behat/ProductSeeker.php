<?php

namespace tests\Behat;

use Behat\Gherkin\Node\TableNode;

trait ProductSeeker
{
    /**
     * @var array
     */
    private $titleIdMap;

    /**
     * @Given products in catalog:
     */
    public function productsInCatalog(TableNode $table)
    {
        foreach ($table->getHash() as $productRow) {
            $this->titleIdMap[$productRow['title']] = $productRow;
        }
    }

    /**
     * @Transform :product
     */
    public function transformProductToProductId($title)
    {
        $product = trim($title);

        if (!array_key_exists($product, $this->titleIdMap)) {
            throw new \Exception("No product with title '{$product}'");
        }

        return $this->titleIdMap[$product];
    }
}