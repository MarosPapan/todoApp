<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function authenticated_user_tasks() {
        /**
         * Only authenticated users should be able to see their tasks.
         */

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $task1 = Task::factory()->create([
            'user_id' => $user1->id,
            'name' => 'User 1 Task',
            'due_at' => now()->addDays(2),
            'description' => 'Task for user 1',
        ]);

        $task2 = Task::factory()->create([
            'user_id' => $user2->id,
            'name' => 'User 2 Task',
            'due_at' => now()->addDays(3),
            'description' => 'Task for user 2',
        ]);

        // Prishlasime sa ako puzivatel 1 a prejdeme na stranku s ulohami
        $response = $this->actingAs($user1)->get('/');
        $response->assertStatus(200);
        $response->assertSee('User 1 Task');
        $response->assertDontSee('User 2 Task');

        //Pozrie sa do view a overi ze tam su len ulohy pouzivatela 1
        $response->assertViewHas('tasks', function ($tasks) use ($task1, $task2) {
            return $tasks->contains($task1) && !$tasks->contains($task2);
        });
    }

    /** @test */
    public function create_task()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('task.add.post'), [
            'user_id' => $user->id,
            'name' => 'New Task',
            'due_at' => now()->addDays(5),
            'description' => 'This is a new task.',
        ]);


        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success', 'Task added successfully.');

        $this->assertDatabaseHas('tasks', [
            'name' => 'New Task',
            'description' => 'This is a new task.',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function update_task () {
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'name' => 'Old Task',
            'due_at' => now()->addDays(2),
            'description' => 'This is an old task.',
        ]);

        $response = $this->actingAs($user)->patch(route('task.update', ['id' => $task->id]), [
            'name' => 'Updated Task',
            'due_at' => now()->addDays(10),
            'description' => 'This task has been updated.',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success', 'Task updated successfully.');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Updated Task',
            'description' => 'This task has been updated.',
        ]);
    }

    /** @test */
    public function delete_task() {
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'name' => 'Task to Delete',
            'due_at' => now()->addDays(2),
            'description' => 'This task will be deleted.',
        ]);

        $response = $this->actingAs($user)->delete(route('task.delete', ['id' => $task->id]));

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success', 'Task deleted successfully.');

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    /** @test */
    public function toggle_task_completion() {
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'name' => 'Task to Toggle',
            'due_at' => now()->addDays(2),
            'description' => 'This task will be toggled.',
            'completed' => false,
        ]);

        $response = $this->actingAs($user)->patch(route('tasks.toggle', ['task' => $task->id]));

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Task marked as completed.');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true,
        ]);

        // Naspat na pending
        $response = $this->actingAs($user)->patch(route('tasks.toggle', ['task' => $task->id]));

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Task marked as pending.');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => false,
        ]);
    }

    /** @test */
    public function view_edit_task() {
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'name' => 'Task to Edit',
            'due_at' => now()->addDays(2),
            'description' => 'This task will be edited.',
        ]);

        $response = $this->actingAs($user)->get(route('task.edit', ['id' => $task->id]));

         $response->assertStatus(200);
         $response->assertViewIs('tasks.edit');
         $response->assertViewHas('task', function ($viewTask) use ($task) {
             return $viewTask->id === $task->id;
         });
    }

    /** @test */
    public function unauthorized_task_access() {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user1->id,
            'name' => 'User 1 Task',
            'due_at' => now()->addDays(2),
            'description' => 'Task for user 1',
        ]);

        
        $response = $this->actingAs($user2)->get(route('task.edit', ['id' => $task->id]));

        
        $response->assertStatus(404);
        //$response->assertSessionHas('error', 'Unauthorized.');
    }

}
