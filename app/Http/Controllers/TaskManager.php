<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Http\Requests\TaskRequest;

class TaskManager extends Controller
{

    function listTasks() {
        $tasks = Task::where("user_id", Auth::id())->orderBy("due_at")->get(); 
        return view("welcome", compact("tasks"));
    }

    function addTask(Request $request) {
        return view('tasks.add');
    }

    function addTaskPost(TaskRequest $request) { 
        
        $task = new Task(); 
        $task->name = $request->name; 
        $task->due_at = $request->due_at; 
        $task->description = $request->description; 
        $task->user_id = auth()->user()->id;
        if($task->save()){ 
            return redirect(route("home"))->with("success", "Task added successfully."); 
        } 
        return redirect(route("task.add"))->with("error", "Failed to add task. Please try again.");
     }   

     
    public function toggle(Task $task): RedirectResponse
    {
        $task->timestamps = false;
        $task->forceFill([
                'completed' => !$task->completed,
            ])->save();

            return back()->with(
                'status',
                $task->completed ? 'Task marked as completed.' : 'Task marked as pending.'
            );
    }

    function editTask($id) {
        $task = Task::where("user_id", auth()->user()->id)
            ->where("id", $id)->firstOrFail();

        
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Unauthorized.');
        }


        return view('tasks.edit', compact('task'));
     }

     function updateTask(TaskRequest $request, $id) {

        if(Task::where("user_id", auth()->user()->id)
            ->where("id", $id)->update([
                "name" => $request->name,
                "due_at" => $request->due_at,
                "description" => $request->description
            ])){
            return redirect(route("home"))->with("success", "Task updated successfully.");
        } 
        return redirect(route("home"))->with("error", "Failed to update task. Please try again.");
     }

    function deleteTask($id) {
        if(Task::where("user_id", auth()->user()->id)
            ->where("id", $id)->delete()){
            return redirect(route("home"))->with("success", "Task deleted successfully.");
        } 
        return redirect(route("home"))->with("error", "Failed to delete task. Please try again.");
     }
}
