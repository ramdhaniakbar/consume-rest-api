@extends('layouts.master')

@section('title', 'User Page')

@section('content')
   <div class="row justify-content-center">
      <div class="col-md-8">
         @if (session('success'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
         @if (session('error'))
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
         <a href="{{ route('user.create') }}"><button type="button" class="btn btn-primary">Create User</button></a>
         <div class="card mt-4">
            <div class="card-header">Base Api</div>
            <table class="table mt-3">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">First Name</th>
                     <th scope="col">Last Name</th>
                     <th scope="col">Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($users['data'] as $user)
                  <tr>
                     <th scope="row">{{ $loop->iteration }}</th>
                     <td>{{ $user['firstName'] }}</td>
                     <td>{{ $user['lastName'] }}</td>
                     <td>
                        <a href="/user/{{ $user['id'] }}/edit"><span class="badge bg-warning text-dark"><i class="bi bi-pencil-square"></i></span></a>
                        <form action="/user/{{ $user['id'] }}" method="POST" id="{{ $user['id'] }}">
                           @method('DELETE')
                           @csrf
                           <button type="button" class="badge bg-danger border-0" onclick="alert('{{ $user['id'] }}')"><i class="bi bi-x-circle"></i></button>
                        </form>
                     </td>
                  </tr>
                  @empty
                  <p class="text-center">No Records Found!</p>
                  @endforelse
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection
@section('cjs')
   <script>
      function alert(id) {
         Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
         if (result.isConfirmed) {
         document.getElementById(id).submit();
         }
         })
      }
      @if (session('successDelete'))
         Swal.fire(
         'Deleted!',
         "{{ session('successDelete') }}",
         'success'
         )
      @endif   
   </script>
@endsection