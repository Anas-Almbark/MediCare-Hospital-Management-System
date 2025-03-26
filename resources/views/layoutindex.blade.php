<!DOCTYPE html>
<html lang="en">

<head>
    @include('indexTemplate.shard.head')
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="{{ asset('js/respond.js') }}"></script><![endif]-->
</head>

<body>

    <div class="page-wrapper">
        <!-- Preloader -->
        <div class="preloader"></div>

        <header class="main-header">
            @if (Request::is('user/home'))
                @include('indexTemplate.shard.navBar')
            @else
                @include('indexTemplate.shard.navBar2')
            @endif


            @yield('content')

            @include('indexTemplate.shard.footer')



            <!--Scroll to top-->
            <div class="scroll-to-top scroll-to-target" data-target="html">
                <span class="fa fa-angle-up"></span>
            </div>
    </div>

    @include('indexTemplate.shard.scripts')

</body>

</html>
