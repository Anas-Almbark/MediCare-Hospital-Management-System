<!DOCTYPE html>
<html lang="en">
    <head>
        @include('indexTemplate.shard.head')
        <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
        <!--[if lt IE 9]><script src="{{ asset('js/respond.js') }}"></script><![endif]-->
        
        <!-- jQuery first -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <!-- Then SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <!-- Then Toastr CSS and JS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        
        <!-- Toastr Default Options -->
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "preventDuplicates": true
            }
        </script>
    </head>
<body>
    @include('indexTemplate.profileuser.shard.navBar')
    @include('indexTemplate.profileuser.shard.sideBar')
    @yield('content')

    <!-- Scripts -->
    <!-- في نهاية الملف، قبل إغلاق تاج body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @include('indexTemplate.shard.scripts')
    @include('partials.messages')  
    <!-- في السايدبار -->
    @php
        $unreadCount = DB::table('notifications')
            ->where('receiver', auth()->id())
            ->where('status', '!=', 'read')
            ->count();
    @endphp
    
    <div class="position-relative">
        <a href="{{ route('notifications') }}" class="nav-link">
            <i class="fas fa-bell"></i> Notifications
            @if($unreadCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $unreadCount }}
                </span>
            @endif
        </a>
    </div>
</body>
</html>