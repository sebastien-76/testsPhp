<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\Attributes\DataProvider;

class ProductTest extends \PHPUnit\Framework\TestCase
{
    public static function providerPricesForFoodProduct(): array
    {
        return [
            [0, 0],
            [20, 2],
            [100, 10],
        ];
    }

    #[DataProvider('providerPricesForFoodProduct')]
    public function testcomputeTVAFoodProduct(int $price, int $expectedTva): void
    {
        $product = new Product('Un produit', Product::FOOD_PRODUCT, $price);
        $this->assertEquals($expectedTva, $product->computeTVA());
    }

    public function testComputeTVAOtherProduct()
    {
        $product2 = new Product('Un autre produit', 'Un autre type de produit', 20);
        $this->assertEquals(4, $product2->computeTVA());
    }

    public function testcomputeNegativeTVAFoodProduct()
    {
        $product3 = new Product('Pomme', 'food', -20);
        $this->expectException('Exception');
        $product3->computeTVA();
    }
}
