@extends('layouts.master')

@section('title', 'User create page')

@section('content')
<a href="/user" class="mb-3 btn btn-danger btn-sm"><i class="bi bi-arrow-left"></i> Back to Home</a>
   <div class="row justify-content-center">
      <form method="POST" action="/user">
         @csrf
         <div class="mb-3 col-md-6">
            <label for="inputFirstName" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" id="inputFirstName">
         </div>
         <div class="mb-3 col-md-6">
            <label for="inputLastName" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="inputLastName">
         </div>
         <div class="mb-3 col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="inputEmail">
         </div>
         <button type="submit" class="btn btn-primary">Create User</button>
      </form>
   </div>
@endsection