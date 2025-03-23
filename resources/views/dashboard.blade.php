<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('dashboard/shard.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher("61f83e8b0f6d41d4e503", {
            cluster: "eu",
            auth: {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
            }
        });

        var userId = 11;
        var channel = pusher.subscribe("private-user-" + userId);
        channel.bind("user-notification", function(data) {
            alert("new notify: " + data.message);
        });
    </script>
</head>

<body class="main-body app sidebar-mini">
    @include('dashboard.shard.loader')
    <div class="page">
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        @include('dashboard.shard.sideBar')
        <div class="main-content app-content">
            @include('dashboard.shard.navBar')
            <!-- container -->
            @yield('content')
            <!-- /Container -->
        </div>
        @include('dashboard.shard.rightSideBar')
        @include('dashboard.shard.footer')
    </div>
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
    @include('dashboard/shard.scripts')
    @stack('scripts')
</body>

</html>
