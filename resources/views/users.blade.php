<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Quickstart - Basic</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }
    </style>
</head>

@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h1>Users List</h1>
        <div class="offset-md-2 col-md-8">
            <div class="card">
                @if (isset($user))
                    <div class="card-header">
                        Update User
                    </div>
                    <div class="card-body">
                        <!-- Update User Form -->
                        <form action="{{ url('userUpdate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <!-- User Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="username" class="form-control" value="{{ $user->name}}">
                            </div>
                            <!-- User Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email}}">
                            </div>
                            <!-- User Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <!-- Update User Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus me-2"></i>Update User
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        New User
                    </div>
                    <div class="card-body">
                        <!-- New User Form -->
                        <form action="userCreate" method="POST">
                            @csrf
                            <!-- User Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">User</label>
                                <input type="text" name="username" id="name" class="form-control" value="">
                            </div>
                            <!-- User Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="">
                            </div>
                            <!-- User Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <!-- Add User Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus me-2"></i>Add User
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Display Current Users -->
            <div class="card">
                <div class="card-header">
                    Current Users
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>

                                        <!-- Form for Editing User -->
                                        <form action="/userEdit/{{ $user->id }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                        </form>

                                        <!-- Form for Deleting User -->
                                        <form action="/userDelete/{{ $user->id }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
