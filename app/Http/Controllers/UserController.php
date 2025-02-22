<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Display a list of users
    public function index()
    {
        // Fetch all users from the database
        $users = DB::table('users')->get();
        // Return the view with the users data
        return view('users', compact('users'));
    }

    // Store a new user
    public function create()
    {
        // Get the user data from the POST request
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];

        // Insert the new user into the database
        DB::table('users')->insert([
            'name' => $user_name,
            'email' => $user_email,
            'password' => bcrypt($user_password), // Hash the password
        ]);

        // Redirect back to the previous page
        return redirect()->back();
    }

    // Delete a user
    public function destroy($id)
    {
        // Delete the user with the given ID from the database
        DB::table('users')->where('id', $id)->delete();
        // Redirect back to the previous page
        return redirect()->back();
    }

    // Show the form for editing a user
    public function edit($id)
    {
        // Fetch the user data by ID
        $user = DB::table('users')->where('id', $id)->first();
        // Fetch all users
        $users = DB::table('users')->get();
        // Return the view with the user and users data
        return view('users', data: compact('user', 'users'));
    }

    // Update a user's data
    public function update()
    {
        // Get the user data from the POST request
        $id = $_POST['id'];
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];

        // Update the user data in the database
        DB::table('users')->where('id', '=', $id)->update([
            'name' => $user_name,
            'email' => $user_email,
            'password' => bcrypt($user_password), // Hash the new password
        ]);

        // Redirect to the users page
        return redirect('users');
    }
}
