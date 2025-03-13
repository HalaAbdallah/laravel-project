<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller
{
    // Display a list of tasks
    public function index()
    {
        // Fetch all tasks from the database
        $tasks = Task::all();
        // Return the view with the tasks data
        return view('tasks', compact('tasks'));
    }

    // Store a new task
    public function create()
    {
        // Get the task name from the POST request
        $task_name = $_POST['name'];
        // Insert the new task into the database
        $task = new Task;
        $task->name = $task_name;
        $task->save();
        // Redirect back to the previous page
        return redirect()->back();
    }

    // Delete a task
    public function destroy($id)
    {
        // Use Eloquent to delete the task
        $task = Task::find($id);
        $task->delete();
        return redirect()->back();
    }

    // Show the form for editing a task
    public function edit($id)
    {
        // Fetch the task data by ID
        $task = DB::table('tasks')->where('id', $id)->first();
        // Fetch all tasks
        $tasks = DB::table('tasks')->get();
        // Return the view with the task and tasks data
        return view('tasks', compact('task', 'tasks'));
    }

    // Update a task's data
    public function update()
    {
        // Use Eloquent to update the task
        $id = $_POST['id'];
        Task::where('id', $id)->update(['name' => $_POST['name']]);
        return redirect('tasks');
    }
}
