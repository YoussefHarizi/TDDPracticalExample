<?php

namespace Tests\Unit;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_has_many_todo_lists()
    {
        $user=$this->createUser();
        $todo=$this->createTodoList(['user_id'=>$user->id]);

        $this->assertInstanceOf(Collection::class,$user->todo_lists);
        $this->assertInstanceOf(TodoList::class,$user->todo_lists->first());
    }
    
}
