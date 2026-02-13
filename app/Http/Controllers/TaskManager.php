<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class TaskManager extends Controller
{

    function listTasks() {
        $tasks = Tasks::where("user_id", Auth::id())->orderBy("due_at")->get(); 
        return view("welcome", compact("tasks"));
    }

    function addTask(Request $request) {
        return view('tasks.add');
    }

    function addTaskPost(Request $request) { 
        $request->validate([
            'name' => 'required|string|max:255',
            'due_at' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $task = new Tasks(); 
        $task->name = $request->name; 
        $task->due_at = $request->due_at; 
        $task->description = $request->description; 
        $task->user_id = auth()->user()->id; // Associate task with the authenticated user
        if($task->save()){ 
            return redirect(route("home"))->with("success", "Task added successfully."); 
        } 
        return redirect(route("task.add"))->with("error", "Failed to add task. Please try again.");
     }   

    //  function updateTaskCompleted($id) {
    //     if(Tasks::where("user_id", auth()->user()->id)
    //         ->where("id", $id)->update([ "completed" => true ])){
    //         return redirect(route("home"))->with("success", "Task marked as completed.");
    //     } 
    //     return redirect(route("home"))->with("error", "Failed to update task. Please try again.");
    //  }

     
    public function toggle(Tasks $task): RedirectResponse
    {
        $task->timestamps = false;
        $task->forceFill([
                'completed' => !$task->completed,
            ])->save();

            return back()->with(
                'status',
                $task->completed ? 'Task marked as completed.' : 'Task marked as pending.'
            );

    
        // $task->completed = !$task->completed; 
        // $task->timestamps = false;
        // $task->save();

        // return back()->with('status', $task->completed
        //     ? 'Task marked as completed.'
        //     : 'Task marked as pending.'
        // );
    }

    function editTask($id) {
        $task = Tasks::where("user_id", auth()->user()->id)
            ->where("id", $id)->firstOrFail();

        
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Unauthorized.');
        }


        return view('tasks.edit', compact('task'));
     }

     function updateTask(Request $request, $id) {

        $request->validate([
            'name' => 'required|string|max:255',
            'due_at' => 'required|date',
            'description' => 'nullable|string'
        ]);

        if(Tasks::where("user_id", auth()->user()->id)
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
        if(Tasks::where("user_id", auth()->user()->id)
            ->where("id", $id)->delete()){
            return redirect(route("home"))->with("success", "Task deleted successfully.");
        } 
        return redirect(route("home"))->with("error", "Failed to delete task. Please try again.");
     }
}
