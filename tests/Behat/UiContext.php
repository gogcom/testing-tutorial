<?php

namespace tests\Behat;

use Behat\Behat\Tester\Exception\PendingException;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;

class UiContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    use ProductSeeker;

    /**
     * @When I add product :product to the cart
     */
    public function iAddProductToTheCart($product)
    {
        $this->visitPath('/game/' . $product['slug'], 'ui');
        $this->getSession('ui')->getPage()->find('css', '.btn-add-to-cart')->click();
    }

    /**
     * @Then my cart count should be :expectedCount
     */
    public function myCartCountShouldBe($expectedCount)
    {
        $count = $this->getSession('ui')->getPage()->find('css', '.top-nav__cart .top-nav__count');
        Assertion::notNull($count);

        Assertion::eq($count->getText(), $expectedCount);
    }

    /**
     * @Then I should be able to see :title in my cart
     */
    public function iShouldBeAbleToSeeInMyCart($title)
    {
        $titleInCart = $this->getSession('ui')->getPage()->find('css', '.top-nav__container--cart .product-title__text');

        Assertion::notNull($titleInCart);
        Assertion::eq(strtoupper($titleInCart->getText()), strtoupper($title));
    }
}
