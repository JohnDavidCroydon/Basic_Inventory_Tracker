<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsTable;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Model\Table\ProductsTable Test Case
 */
class ProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductsTable
     */
    protected ProductsTable $Products;

    /**
     * Fixtures
     *
     * @var array
     */
    protected array $fixtures = [
        'app.Products', // This will automatically load ProductsFixture
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->Products = TableRegistry::getTableLocator()->get('Products');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Products);
        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        // Create a new product entity
        $product = $this->Products->newEntity([
            'name' => '', // Empty name to trigger validation error
            'quantity' => -1, // Invalid quantity
            'price' => -10, // Invalid price
            'status' => 'in stock', // Valid status
        ]);

        // Get validation errors
        $errors = $product->getErrors();

        // Assert that the name field has an error (empty string)
        $this->assertArrayHasKey('name', $errors);
        $this->assertNotEmpty($errors['name']);

        // Assert that the quantity field has an error (negative value)
        $this->assertArrayHasKey('quantity', $errors);
        $this->assertNotEmpty($errors['quantity']);

        // Assert that the price field has an error (negative value)
        $this->assertArrayHasKey('price', $errors);
        $this->assertNotEmpty($errors['price']);
    }

    /**
     * Test if the ProductsFixture data is loaded correctly
     *
     * @return void
     */
    public function testFixtureDataLoaded(): void
    {
        // Count the number of products loaded from the fixture
        $products = $this->Products->find()->all();
        $this->assertCount(5, $products);  // Assert that 5 products are in the fixture
    }

    /**
     * Test status based on quantity
     *
     * @return void
     */
    public function testStatusBasedOnQuantity(): void
    {
        // Create a product with quantity 10 (in stock)
        $product = $this->Products->newEntity([
            'name' => 'Test Product',
            'quantity' => 10,
            'price' => 100,
            'status' => '', // Status should be calculated
        ]);
        $this->Products->save($product);

        // Assert that status is 'in stock' (lowercase)
        $this->assertEquals('in stock', $product->status);

        // Create a product with quantity 0 (out of stock)
        $productOutOfStock = $this->Products->newEntity([
            'name' => 'Test Product 2',
            'quantity' => 0,
            'price' => 50,
            'status' => '', // Status should be calculated
        ]);
        $this->Products->save($productOutOfStock);

        // Assert that status is 'out of stock' (lowercase)
        $this->assertEquals('out of stock', $productOutOfStock->status);
    }
}
