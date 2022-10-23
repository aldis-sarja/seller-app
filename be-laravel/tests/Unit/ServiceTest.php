<?php

namespace Tests\Unit;

use App\Models\Service;
use App\Repositories\ClientRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ServiceRepository;
use App\Services\Client\ClientData;
use App\Services\Client\CreateClientService;
use App\Services\Product\CreateProductService;
use App\Services\Product\ProductData;
use App\Services\Service\CreateServiceService;
use App\Services\Service\DeleteServiceService;
use App\Services\Service\GetServiceByIdService;
use App\Services\Service\ServiceData;
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
        $productRequest = new ProductData(
            'TV01',
            'electronics',
            'The thing, that we almost are not using'
        );
        $product = (new CreateProductService(new ProductRepository))->execute($productRequest);

        $clientRequest = new ClientData(
            'Client01',
            'space',
            '--====+====--'
        );
        $client = (new CreateClientService(new ClientRepository))->execute($clientRequest);

        $serviceRequest = new ServiceData(
            $client->id,
            $product->id,
            42,
            Carbon::now()
        );
        $service = (new CreateServiceService(new ServiceRepository))->execute($serviceRequest);

        $this->assertNotNull($service);
        $this->assertEquals($client->id, $service->client_id);
        $this->assertEquals($product->id, $service->product_id);
        $this->assertEquals(42, $service->price);
    }

    public function test_it_should_be_able_to_get_service_by_id()
    {
        $productRequest = new ProductData(
            'TV01',
            'electronics',
            'The thing, that we almost are not using'
        );
        $product = (new CreateProductService(new ProductRepository))->execute($productRequest);

        $clientRequest = new ClientData(
            'Client01',
            'space',
            '--====+====--'
        );
        $client = (new CreateClientService(new ClientRepository))->execute($clientRequest);

        $serviceRequest = new ServiceData(
            $client->id,
            $product->id,
            42,
            Carbon::now()
        );
        (new CreateServiceService(new ServiceRepository))->execute($serviceRequest);

        $service = (new GetServiceByIdService(new ServiceRepository))->execute(1);

        $this->assertNotNull($service);
        $this->assertEquals($client->id, $service->client_id);
        $this->assertEquals($product->id, $service->product_id);
        $this->assertEquals(42, $service->price);
        $this->assertEquals('Client01', $service->client->name);
        $this->assertEquals('TV01', $service->product->name);
    }

    public function test_it_should_be_able_to_update_service()
    {
        $productRequest = new ProductData(
            'TV01',
            'electronics',
            'The thing, that we almost are not using'
        );
        $product = (new CreateProductService(new ProductRepository))->execute($productRequest);

        $clientRequest = new ClientData(
            'Client01',
            'space',
            '--====+====--'
        );
        $client = (new CreateClientService(new ClientRepository))->execute($clientRequest);

        $serviceRequest = new ServiceData(
            $client->id,
            $product->id,
            42,
            Carbon::now()
        );
        $service = (new CreateServiceService(new ServiceRepository))->execute($serviceRequest);

        $serviceRequest = new ServiceData(
            $client->id,
            $product->id,
            13,
            Carbon::now(),
            $service->id
        );

        $service = (new UpdateServiceService(new ServiceRepository))->execute($serviceRequest);

        $this->assertNotNull($service);
        $this->assertEquals($client->id, $service->client_id);
        $this->assertEquals($product->id, $service->product_id);
        $this->assertEquals(13, $service->price);
    }

    public function test_it_should_be_able_to_delete_service()
    {
        $productRequest = new ProductData(
            'TV01',
            'electronics',
            'The thing, that we almost are not using'
        );
        $product = (new CreateProductService(new ProductRepository))->execute($productRequest);

        $clientRequest = new ClientData(
            'Client01',
            'space',
            '--====+====--'
        );
        $client = (new CreateClientService(new ClientRepository))->execute($clientRequest);

        $serviceRequest = new ServiceData(
            $client->id,
            $product->id,
            42,
            Carbon::now()
        );
        $service = (new CreateServiceService(new ServiceRepository))->execute($serviceRequest);

        $service = (new DeleteServiceService(new ServiceRepository))->execute(1);

        $this->assertEquals(true, $service);
    }
}
