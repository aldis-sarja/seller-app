<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\Product\CreateProductService;
use App\Services\Product\DeleteProductService;
use App\Services\Product\GetProductByIdService;
use App\Services\Product\ProductData;
use App\Services\Product\UpdateProductService;
use Tests\Testcase;

class ProductTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    public function test_it_should_be_able_to_make_product_model()
    {
        $product = new Product([
            'name' => 'TV01',
            'type' => 'electronics',
            'description' => 'The thing, that we almost are not using',
        ]);

        $this->assertNotNull($product);
        $this->assertEquals('TV01', $product->name);
        $this->assertEquals('electronics', $product->type);
        $this->assertEquals('The thing, that we almost are not using', $product->description);
    }

    public function test_it_should_be_able_to_create_product()
    {
        $request = new ProductData(
            'TV01',
            'electronics',
            'The thing, that we almost are not using'
        );

        $product = (new CreateProductService(new ProductRepository))->execute($request);

        $this->assertNotNull($product);
        $this->assertEquals('TV01', $product->name);
        $this->assertEquals('electronics', $product->type);
        $this->assertEquals('The thing, that we almost are not using', $product->description);
    }

    public function test_it_should_be_able_to_get_product_by_id()
    {
        $request = new ProductData(
            'TV01',
            'electronics',
            'The thing, that we almost are not using'
        );

        (new CreateProductService(new ProductRepository))->execute($request);

        $product = (new GetProductByIdService(new ProductRepository))->execute(1);

        $this->assertNotNull($product);
        $this->assertEquals('TV01', $product->name);
        $this->assertEquals('electronics', $product->type);
        $this->assertEquals('The thing, that we almost are not using', $product->description);
    }

    public function test_it_should_be_able_to_update_product()
    {
        $request = new ProductData(
            'TV01',
            'electronics',
            'The thing, that we almost are not using'
        );

        $product = (new CreateProductService(new ProductRepository))->execute($request);

        $request = new ProductData(
            'TV02',
            'vegetable',
            'Don\'t eat!',
            $product->id
        );

        $product = (new UpdateProductService(new ProductRepository))->execute($request);

        $this->assertNotNull($product);
        $this->assertEquals('TV02', $product->name);
        $this->assertEquals('vegetable', $product->type);
        $this->assertEquals('Don\'t eat!', $product->description);
    }

    public function test_it_should_be_able_to_delete_product()
    {
        $request = new ProductData(
            'TV01',
            'electronics',
            'The thing, that we almost are not using'
        );

        (new CreateProductService(new ProductRepository))->execute($request);

        $res = (new DeleteProductService(new ProductRepository))->execute(1);

        $this->assertEquals(true, $res);
    }
}
