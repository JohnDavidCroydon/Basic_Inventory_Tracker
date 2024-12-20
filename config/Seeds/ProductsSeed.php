<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Products seed.
 */
class ProductsSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $productsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Products');

        // Sample products data
        $products = [
            ['name' => 'Product 1', 'quantity' => 10, 'price' => 100.0, 'status' => 'in stock'],
            ['name' => 'Product 2', 'quantity' => 5, 'price' => 200.0, 'status' => 'in stock'],
            ['name' => 'Product 3', 'quantity' => 0, 'price' => 150.0, 'status' => 'out of stock'],
            ['name' => 'Product 4', 'quantity' => 20, 'price' => 50.0, 'status' => 'in stock'],
            ['name' => 'Product 5', 'quantity' => 3, 'price' => 300.0, 'status' => 'in stock'],
        ];

        // Insert the products into the database
        foreach ($products as $product) {
            $productsTable->save($productsTable->newEntity($product));
        }

        echo "Sample products have been seeded.\n";
    }
}
