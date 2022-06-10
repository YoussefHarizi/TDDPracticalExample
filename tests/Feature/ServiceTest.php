<?php

namespace Tests\Feature;

use App\Models\Service;
use Google\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery\MockInterface;

class ServiceTest extends TestCase
{
    use RefreshDatabase;
    function setUp(): void
    {
        parent::setUp();
        $this->user=$this->authUser();
    }
   /** @test */
   public function a_user_can_connect_to_google_drive()
   {
       $response=$this->getJson(route('service.connect','google-drive'))
       ->assertOk()
       ->json();
       $this->assertNotNull($response['url']);
   }
   /** @test */
   public function service_callback_will_store_token()
   {
        $mock = $this->mock(Client::class, function (MockInterface $mock) {
            $mock->shouldReceive('setClientId')->once();
            $mock->shouldReceive('setClientSecret')->once();
            $mock->shouldReceive('setRedirectUri')->once();
            $mock->shouldReceive('fetchAccessTokenWithAuthCode')
            ->andReturn('fake-access');
        });
       $response=$this->postJson(route('service.callback',[
        'code'=>'dummy data'
        ]))->assertCreated();
        $this->assertDatabaseHas('services',['user_id'=>$this->user->id]);
   }
   
   
}
