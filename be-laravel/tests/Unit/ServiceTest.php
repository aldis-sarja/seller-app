<?php

namespace Tests\Unit;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Repositories\ClientRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ServiceRepository;
use App\Services\Client\CreateClientService;
use App\Services\Product\CreateProductService;
use App\Services\Service\CreateServiceService;
use App\Services\Service\DeleteServiceService;
use App\Services\Service\GetServiceByIdService;
use App\Services\Service\UpdateServiceService;
use Illuminate\Support\Carbon;
use Tests\Testcase;

class ServiceTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    public function test_it_should_be_able_to_make_service_model()
    {
        $dateTime = Carbon::now();
        $service = new Service([
            'client_id' => 1,
            'product_id' => 1,
            'price' => 42,
            'date' => $dateTime,
        ]);

        $this->assertNotNull($service);
        $this->assertEquals(1, $service->client_id);
        $this->assertEquals(1, $service->product_id);
        $this->assertEquals(42, $service->price);
        $this->assertEquals($dateTime, $service->date);
    }

    public function test_it_should_be_able_to_create_service()
    {
        $request = new ProductRequest([
            'name' => 'TV01',
            'type' => 'electronics',
            'description' => 'The thing, that we almost are not using',
        ]);
        $product = (new CreateProductService(new ProductRepository))->execute($request);

        $request = new ClientRequest([
            'name' => 'Client01',
            'address' => 'space',
            'description' => '--====+====--',
        ]);
        $client = (new CreateClientService(new ClientRepository))->execute($request);

        $request = new ServiceRequest([
            'client_id' => $client->id,
            'product_id' => $product->id,
            'price' => 42,
            'date' => Carbon::now(),
        ]);
        $service = (new CreateServiceService(new ServiceRepository))->execute($request);

        $this->assertNotNull($service);
        $this->assertEquals($client->id, $service->client_id);
        $this->assertEquals($product->id, $service->product_id);
        $this->assertEquals(4200, $service->price);
    }

    public function test_it_should_be_able_to_get_service_by_id()
    {
        $request = new ProductRequest([
            'name' => 'TV01',
            'type' => 'electronics',
            'description' => 'The thing, that we almost are not using',
        ]);
        $product = (new CreateProductService(new ProductRepository))->execute($request);

        $request = new ClientRequest([
            'name' => 'Client01',
            'address' => 'space',
            'description' => '--====+====--',
        ]);
        $client = (new CreateClientService(new ClientRepository))->execute($request);

        $request = new ServiceRequest([
            'client_id' => $client->id,
            'product_id' => $product->id,
            'price' => 42,
            'date' => Carbon::now(),
        ]);
        (new CreateServiceService(new ServiceRepository))->execute($request);

        $service = (new GetServiceByIdService(new ServiceRepository))->execute(1);

        $this->assertNotNull($service);
        $this->assertEquals($client->id, $service->client_id);
        $this->assertEquals($product->id, $service->product_id);
        $this->assertEquals(4200, $service->price);
        $this->assertEquals('Client01', $service->client->name);
        $this->assertEquals('TV01', $service->product->name);
    }

    public function test_it_should_be_able_to_update_service()
    {
        $request = new ProductRequest([
            'name' => 'TV01',
            'type' => 'electronics',
            'description' => 'The thing, that we almost are not using',
        ]);
        $product = (new CreateProductService(new ProductRepository))->execute($request);

        $request = new ClientRequest([
            'name' => 'Client01',
            'address' => 'space',
            'description' => '--====+====--',
        ]);
        $client = (new CreateClientService(new ClientRepository))->execute($request);

        $request = new ServiceRequest([
            'client_id' => $client->id,
            'product_id' => $product->id,
            'price' => 42,
            'date' => Carbon::now(),
        ]);
        $service = (new CreateServiceService(new ServiceRepository))->execute($request);

        $request = new ServiceRequest([
            'client_id' => $client->id,
            'product_id' => $product->id,
            'price' => 13,
            'date' => Carbon::now(),
        ]);

        $service = (new UpdateServiceService(new ServiceRepository))->execute($service->id, $request);

        $this->assertNotNull($service);
        $this->assertEquals($client->id, $service->client_id);
        $this->assertEquals($product->id, $service->product_id);
        $this->assertEquals(1300, $service->price);
    }

    public function test_it_should_be_able_to_delete_service()
    {
        $request = new ProductRequest([
            'name' => 'TV01',
            'type' => 'electronics',
            'description' => 'The thing, that we almost are not using',
        ]);
        $product = (new CreateProductService(new ProductRepository))->execute($request);

        $request = new ClientRequest([
            'name' => 'Client01',
            'address' => 'space',
            'description' => '--====+====--',
        ]);
        $client = (new CreateClientService(new ClientRepository))->execute($request);

        $request = new ServiceRequest([
            'client_id' => $client->id,
            'product_id' => $product->id,
            'price' => 42,
            'date' => Carbon::now(),
        ]);
        (new CreateServiceService(new ServiceRepository))->execute($request);

        $service = (new DeleteServiceService(new ServiceRepository))->execute(1);

        $this->assertEquals(true, $service);
    }
}
