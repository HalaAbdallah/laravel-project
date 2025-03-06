<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a list of users
    public function index()
    {
        // Fetch all users from the database
        //$users = DB::table('users')->get();
        $users = User::all();
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
        /*DB::table('users')->insert([
            'name' => $user_name,
            'email' => $user_email,
            'password' => bcrypt($user_password), // Hash the password
        ]);
        */

        $user = new User;
        $user->name = $user_name;
        $user->email = $user_email;
        $user->password = bcrypt($user_password);

        $user->save();
        // Redirect back to the previous page
        return redirect()->back();
    }

    // Delete a user
    public function destroy($id)
    {
        // Use Eloquent to delete the user
        $user = User::find($id);
        $user->delete();
        return redirect()->back();

        /*
        //Delete the user with the given ID from the database
        DB::table('users')->where('id', $id)->delete();
        // Redirect back to the previous page
        return redirect()->back();
        */
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
        // Use Eloquent to update the user
        $id = $_POST['id'];
        $user = User::findOrfail($id);
        $user->update([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => bcrypt($_POST['password']),
        ]);
        return redirect('users');


        /*
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
        */
    }
}
