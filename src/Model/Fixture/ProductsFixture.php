<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ProductsFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'products';

    /**
     * Fields to insert
     *
     * @var array
     */
    public array $fields = [
        'id' => ['type' => 'integer', 'autoIncrement' => true],
        'name' => ['type' => 'string', 'length' => 255],
        'quantity' => ['type' => 'integer'],
        'price' => ['type' => 'float'],
        'status' => ['type' => 'string', 'length' => 255],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
        ],
    ];

    /**
     * Records to insert into the fixture
     *
     * @var array
     */
    public array $records = [
        [
            'name' => 'Product 1',
            'quantity' => 10,
            'price' => 100.00,
            'status' => 'in stock',
        ],
        [
            'name' => 'Product 2',
            'quantity' => 5,
            'price' => 50.00,
            'status' => 'in stock',
        ],
        [
            'name' => 'Product 3',
            'quantity' => 0,
            'price' => 30.00,
            'status' => 'out of stock',
        ],
        [
            'name' => 'Product 4',
            'quantity' => 20,
            'price' => 200.00,
            'status' => 'in stock',
        ],
        [
            'name' => 'Product 5',
            'quantity' => 15,
            'price' => 150.00,
            'status' => 'in stock',
        ],
    ];
}
