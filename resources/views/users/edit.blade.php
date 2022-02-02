@extends('layouts.layout')

@section('title', 'Edit User')

@section('content')
    <form method="post" action="{{route('users.update', $user)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
        </div>
        @error('name')
        <div class="alert alert-danger text-center p-2">
            {{$message}}
        </div>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
        </div>
        @error('email')
        <div class="alert alert-danger text-center p-2">
            {{$message}}
        </div>
        @enderror
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
        </div>
        @error('phone')
        <div class="alert alert-danger text-center p-2">
            {{$message}}
        </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        @error('password')
        <div class="alert alert-danger text-center p-2">
            {{$message}}
        </div>
        @enderror
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">New Password Confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$user->title}}">
        </div>
        @error('title')
        <div class="alert alert-danger text-center p-2">
            {{$message}}
        </div>
        @enderror
        <div class="mb-3">
            <label for="specialty" class="form-label">Specialty</label>
            <input type="text" class="form-control" id="specialty" name="specialty" value="{{$user->specialty}}">
        </div>
        @error('specialty')
        <div class="alert alert-danger text-center p-2">
            {{$message}}
        </div>
        @enderror
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        @error('image')
        <div class="alert alert-danger text-center p-2">
            {{$message}}
        </div>
        @enderror
        <div class="text-center mb-3">
            <p>Current Image</p>
            <img src="{{$user->imgSrc()}}" class="img-fluid border" width="500" height="500">
        </div>
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
