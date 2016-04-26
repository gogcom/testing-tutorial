<?php

namespace tests\Behat;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use GOG\Website\Shopping\Cart;
use Ramsey\Uuid\Uuid;

class DomainContext implements Context, SnippetAcceptingContext
{
    use ProductSeeker;

    /**
     * @var Cart
     */
    private $cart;

    public function __construct()
    {
        $this->cart = new Cart(Uuid::uuid4());
    }

    /**
     * @When I add product :product to the cart
     */
    public function iAddProductToTheCart($product)
    {
        $this->cart->add($product['id']);
    }

    /**
     * @Then my cart count should be :count
     */
    public function myCartCountShouldBe($count)
    {
        Assertion::eq($this->cart->count(), $count);
    }

    /**
     * @Then I should be able to see :product in my cart
     */
    public function iShouldBeAbleToSeeInMyCart($product)
    {
        Assertion::true($this->cart->exists($product['id']));
    }
}
