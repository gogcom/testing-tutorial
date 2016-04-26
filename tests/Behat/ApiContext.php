<?php

namespace tests\Behat;

use Behat\Behat\Tester\Exception\PendingException;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;

class ApiContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    use ProductSeeker;

    /**
     * @When I add product :product to the cart
     */
    public function iAddProductToTheCart($product)
    {
        $this->visitPath(sprintf('/cart/add/%d', $product['id']), 'api');
        Assertion::eq($this->getSession('api')->getStatusCode(), 200);
    }

    /**
     * @Then I should be able to see :product in my cart
     */
    public function iShouldBeAbleToSeeInMyCart($product)
    {
        $this->visitPath('/cart', 'api');
        $body = $this->getSession('api')->getPage()->getContent();
        $body = json_decode($body, true);

        Assertion::keyExists($body['cart'], $product['id']);
    }

    /**
     * @Then my cart count should be :count
     */
    public function myCartCountShouldBe($count)
    {
        $this->visitPath('/cart', 'api');
        $body = $this->getSession('api')->getPage()->getContent();
        $body = json_decode($body, true);

        Assertion::count($body['cart'], (int) $count);
    }
}
