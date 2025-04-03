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
    <style>
        .main-content {
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding: 20px;
            width: 100%;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .page {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .app-content {
            flex: 1;
        }

        /* Override any existing sidebar margins */
        .app.sidebar-mini {
            --sidebar-width: 0px;
        }
    </style>
</head>

<body class="main-body">
    <div class="page">
        <div class="main-content app-content">
            @include('dashboard.shard.navBar')
            <div class="container">
                @yield('content')
            </div>
        </div>
        @include('indexTemplate/profileuser/shard.rightSideBar')

        @include('indexTemplate/profileuser/shard.footer')
    </div>
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
    @include('indexTemplate/profileuser/shard.scripts')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
