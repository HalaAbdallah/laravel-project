<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    // Display a list of tasks
    public function index()
    {
        // Fetch all tasks from the database
        $tasks = DB::table('tasks')->get();
        // Return the view with the tasks data
        return view('tasks', data: compact('tasks'));
    }

    // Store a new task
    public function create()
    {
        // Get the task name from the POST request
        $task_name = $_POST['name'];
        // Insert the new task into the database
        DB::table('tasks')->insert(['name' => $task_name]);
        // Redirect back to the previous page
        return redirect()->back();
    }

    // Delete a task
    public function destroy($id)
    {
        // Delete the task with the given ID from the database
        DB::table('tasks')->where('id', $id)->delete();
        // Redirect back to the previous page
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
        return view('tasks', data: compact('task', 'tasks'));
    }

    // Update a task's data
    public function update()
    {
        // Get the task ID from the POST request
        $id = $_POST['id'];
        // Update the task name in the database
        DB::table('tasks')->where('id', '=', $id)->update(['name' => $_POST['name']]);
        // Redirect to the tasks page
        return redirect('tasks');
    }
}
