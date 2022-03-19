<!DOCTYPE html>
<html lang="en">
<head>
   @include('layouts.head')
</head>
<body>
   
   @include('layouts.navbar')
   <div class="container mt-4">

      @yield('content')
   </div>

   @include('layouts.scripts')
</body>
</html>