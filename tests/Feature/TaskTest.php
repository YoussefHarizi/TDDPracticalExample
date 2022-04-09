<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    private $task;
    public function setUp():void
    {
        parent::setUp();
        $this->task=$this->createTask();
    }
    /** @test */
    public function fetch_all_tasks()
    {
        $response=$this->getJson(route('task.index'))
        ->assertOk()
        ->json();

        $this->assertEquals(1, count($response));
        $this->assertEquals($this->task->title, $response[0]['title']);
    }
    
}
