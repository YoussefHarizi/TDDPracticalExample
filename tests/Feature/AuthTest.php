<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
  /** @test */
  public function a_user_can_register()
  {
      $user=User::factory()->make();
      $response=$this->postJson(route('user.register'),[
          'name'=>$user->name,
          'email'=>$user->email,
          'password'=>$user->password,
          'password_confirmation'=>$user->password
      ])->assertCreated()
      ->json();
      $this->assertDatabaseHas('users',['email'=>$response['email']]);
  }

  /** @test */
  public function a_user_can_logged_in()
  {
      $user=$this->createUser([ 'password' => 'password']);
      $response=$this->postJson(route('user.login'),[
          'email'=>$user->email,
          'password'=>'password'
      ])->assertOk();
      $this->assertArrayHasKey('token',$response->json());
  }
  /** @test */
  public function it_raise_error_if_password_is_incorrect()
  {
      $user=$this->createUser();
      $response=$this->postJson(route('user.login'),[
          'email'=>$user->email,
          'password'=>'incorrectpassword'
      ])->assertUnauthorized();
  }
  
  
}
