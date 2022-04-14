<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    private $task;
    private $list;
    public function setUp():void
    {
        parent::setUp();
        $this->list=$this->createTodoList();
        $this->task=$this->createTask(['todo_list_id'=>$this->list->id]);
    }
    /** @test */
    public function fetch_all_tasks()
    {
        $task2=$this->createTask();
        $response=$this->getJson(route('todo-list.task.index',$this->list->id))
        ->assertOk()
        ->json();

        $this->assertEquals(1, count($response));
        $this->assertEquals($this->task->title, $response[0]['title']);
    }


    /** @test */
    public function store_task()
    {
        $task=Task::factory()->make();
        $response=$this->postJson(route('todo-list.task.store',$this->list->id),['title'=>$task->title])
        ->assertCreated()
        ->json();
        // dd($response);
        $this->assertDatabaseHas('tasks',['title'=>$task->title,'todo_list_id'=>$this->list->id]);
    }

     /** @test */
     public function update_task()
     {
         $this->patchJson(route('task.update',$this->task->id),['title'=>'updated title'])
         ->assertOk();
         $this->assertDatabaseHas('tasks',['id'=>$this->task->id,'title'=>'updated title']);
 
     }

         /** @test */
    public function delete_task()
    {
        $this->deleteJson(route('task.destroy',$this->task->id))
        ->assertNoContent();
        $this->assertDataBaseMissing('todo_lists',['id'=>$this->task->id,'title'=>$this->task->title]);

    }
    
    
}
