<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
/** @test */
public function fetch_todo_list()
{
    TodoList::factory()->create();
    $response=$this->get(route('todo-list.index'));
    $this->assertEquals(1,count($response->json()));
}

}
