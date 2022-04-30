<?php

namespace Tests\Feature;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
   use RefreshDatabase;
   private $label;
   public function setUp():void
   {
       parent::setUp();
       $user=$this->authUser();
       $this->label=$this->createLabel(['user_id'=>$user->id]);
   }

   /** @test */
   public function a_user_can_store_new_label()
   {
       $label=Label::factory()->raw();
       $response=$this->postJson(route('label.store'),$label)
       ->assertCreated();

        $this->assertDatabaseHas('labels',[
            'title'=>$label['title'],
            'color'=>$label['color']
        ]);
   }

   /** @test */
   public function a_user_can_fetch_his_labels()
   {
       $this->createLabel();
       $response=$this->getJson(route('label.index'))
       ->assertOk()
       ->json();

       $this->assertEquals(1,count($response));

   }
   
   /** @test */
   public function a_user_can_update_label()
   {
       $response=$this->PatchJson(route('label.update',$this->label->id),[
           "title"=>$this->label->title,
           "color"=>"yellow"
       ])
       ->assertOk();

        $this->assertDatabaseHas('labels',['id'=>$this->label->id,"color"=>"yellow"]);
   }

   /** @test */
   public function a_user_can_delete_label()
   {
       $response=$this->deleteJson(route('label.destroy',$this->label->id))
       ->assertNoContent();
       $this->assertDatabaseMissing('labels',['id'=>$this->label->id]);
   }
   
   
}
