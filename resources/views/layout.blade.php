<!DOCTYPE html>
<html lang="en">

<head>
    @include('shared.head');
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var userId = @json(Auth::id());
        console.log(" User ID: " + userId);
        var pusher = new Pusher("6d433aab38bb5ce68498", {
            cluster: "eu",
            encrypted: true,
            authEndpoint: "/broadcasting/auth",
            auth: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
        });
        
        var channel = pusher.subscribe("notifications");
        channel.bind("done", function(data) {
            console.log("Done");
        });
    </script>
</head>

<body>
    @include('shared.navBar')
    <main class="site-main">
        @yield('content')
    </main>
    @include('shared.footer')
    @include('shared.scripts')
</body>

</html>
