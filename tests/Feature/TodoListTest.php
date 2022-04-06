<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
/** @test */
public function fetch_todo_list()
{
    $response=$this->get(route('todo-list.index'));
    $this->assertEquals(1,count($response->json()));
}

}
