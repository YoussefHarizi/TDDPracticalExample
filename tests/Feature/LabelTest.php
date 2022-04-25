<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
   use RefreshDatabase;
   public function setUp():void
   {
       parent::setUp();
       $this->authUser();
   }

   /** @test */
   public function a_user_can_store_new_label()
   {
       $response=$this->postJson(route('label.store'),[
           'title'=>'new label',
           'color'=>'bleu'
       ])->assertCreated();

        $this->assertDatabaseHas('labels',['title'=>'new label','color'=>'bleu']);
   }
   
}
