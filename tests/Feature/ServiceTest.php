<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;
    function setUp(): void
    {
        parent::setUp();
        $this->authUser();
    }
   /** @test */
   public function a_user_can_connect_to_google_drive()
   {
       $response=$this->getJson(route('service.connect','google-drive'))
       ->assertOk()
       ->json();
       $this->assertNotNull($response['url']);
   }
   
}
