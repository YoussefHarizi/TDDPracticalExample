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
        $user=$this->authUser();
        $this->list=$this->createTodoList(['user_id'=>$user->id]);
    }

    /** @test */
    public function fetch_all_todo_list()
    {
        $this->createTodoList();
        
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
        $response=$this->postJson(route('todo-list.store'),[
            'name'=>$list->name,
            'user_id'=>$list->user_id,
            ])
        ->assertCreated()
        ->json();

        $this->assertEquals($list->name,$response['name']);
        $this->assertDatabaseHas('todo_lists',['name'=>$list->name]);
    }

    /** @test */
    public function name_required_when_store_new_todolist()
    {
        $this->withExceptionHandling();
        $response=$this->postJson(route('todo-list.store'))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function delete_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy',$this->list->id))
        ->assertNoContent();
        $this->assertDataBaseMissing('todo_lists',['id'=>$this->list->id,'name'=>$this->list->name]);

    }

    /** @test */
    public function update_todo_list()
    {
        $this->patchJson(route('todo-list.update',$this->list->id),['name'=>'updated name'])
        ->assertOk();
        $this->assertDatabaseHas('todo_lists',['id'=>$this->list->id,'name'=>'updated name']);

    }

    /** @test */
    public function name_required_when_updating_todolist()
    {
        $this->withExceptionHandling();
        $response=$this->patchJson(route('todo-list.update',$this->list->id))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);
    }

    
    
    


}
