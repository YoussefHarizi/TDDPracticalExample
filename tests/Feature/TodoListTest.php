<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    private $list;

    public function setUp():void    
    {
        parent::setUp();
        $this->list=TodoList::factory()->create();
    }

    /** @test */
    public function fetch_all_todo_list()
    {
        
        $response=$this->get(route('todo-list.index'))
        ->json();

        $this->assertEquals(1,count($response));
    }

    /** @test */
    public function fetch_single_todo_list()
    {
        
    

        $response=$this->get(route('todo-list.show',$this->list->id))
                    ->assertOk()
                    ->json();
    
        $this->assertEquals($this->list->name,$response['name']);
    }

    /** @test */
    public function store_new_todo_list()
    {
        $list=TodoList::factory()->make();
        $response=$this->postJson(route('todo-list.store'),['name'=>$list->name])
        ->assertCreated()
        ->json();

        $this->assertEquals($list->name,$response['name']);
        $this->assertDatabaseHas('todo_lists',['name'=>$list->name]);
    }
    


}
