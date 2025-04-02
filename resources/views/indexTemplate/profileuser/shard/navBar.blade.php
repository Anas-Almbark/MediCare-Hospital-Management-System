<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
     <div class="container">
         <a class="navbar-brand" href="{{ route('welcome') }}">
            
         </a>
         <div class="d-flex">
             <a href="{{ route('welcome') }}" class="btn btn-outline-light me-2">Home</a>
             <form action="{{ route('logout') }}" method="POST" class="d-inline">
                 @csrf
                 <button type="submit" class="btn btn-outline-light">Logout</button>
             </form>
         </div>
     </div>
 </nav>
 