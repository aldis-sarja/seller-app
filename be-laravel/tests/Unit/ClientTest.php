<?php

namespace Tests\Unit;


use App\Models\Client;

use App\Repositories\ClientRepository;
use App\Services\Client\ClientData;
use App\Services\Client\CreateClientService;
use App\Services\Client\DeleteClientService;
use App\Services\Client\GetClientByIdService;
use App\Services\Client\UpdateClientService;
use Tests\Testcase;

class ClientTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    public function test_it_should_be_able_to_make_client_model()
    {
        $client = new Client([
            'name' => 'Client01',
            'address' => 'space',
            'description' => '--====+====--',
        ]);

        $this->assertNotNull($client);
        $this->assertEquals('Client01', $client->name);
        $this->assertEquals('space', $client->address);
        $this->assertEquals('--====+====--', $client->description);
    }

    public function test_it_should_be_able_to_create_client()
    {
        $request = new ClientData(
            'Client01',
            'space',
            '--====+====--'
        );

        $client = (new CreateClientService(new ClientRepository))->execute($request);

        $this->assertNotNull($client);
        $this->assertEquals('Client01', $client->name);
        $this->assertEquals('space', $client->address);
        $this->assertEquals('--====+====--', $client->description);
    }

    public function test_it_should_be_able_to_get_client_by_id()
    {
        $request = new ClientData(
            'Client01',
            'space',
            '--====+====--'
        );

        (new CreateClientService(new ClientRepository))->execute($request);

        $client = (new GetClientByIdService(new ClientRepository))->execute(1);

        $this->assertNotNull($client);
        $this->assertEquals('Client01', $client->name);
        $this->assertEquals('space', $client->address);
        $this->assertEquals('--====+====--', $client->description);
    }

    public function test_it_should_be_able_to_update_client()
    {
        $request = new ClientData(
            'Client01',
            'space',
            '--====+====--'
        );

        $client = (new CreateClientService(new ClientRepository))->execute($request);

        $request = new ClientData(
            'Client02',
            'Earth',
            '--====[]====--',
            $client->id
        );

        $client = (new UpdateClientService(new ClientRepository))->execute($request);

        $this->assertNotNull($client);
        $this->assertEquals('Client02', $client->name);
        $this->assertEquals('Earth', $client->address);
        $this->assertEquals('--====[]====--', $client->description);
    }

    public function test_it_should_be_able_to_delete_client()
    {
        $request = new ClientData(
            'Client01',
            'space',
            '--====+====--'
        );

        (new CreateClientService(new ClientRepository))->execute($request);

        $res = (new DeleteClientService(new ClientRepository))->execute(1);

        $this->assertEquals(true, $res);
    }
}
