Feature: Visitor can add item to the cart and shop
    In order to make a purchase
    As a visitor
    I need to be able to add products to the cart

    Background:
        Given products in catalog:
            | id         | title          | slug           |
            | 1453375253 | Stardew valley | stardew_valley |

    @domain
    @api
    @ui
    Scenario: Add product to a cart
        When I add product "Stardew valley" to the cart
        Then my cart count should be 1
         And I should be able to see "Stardew valley" in my cart