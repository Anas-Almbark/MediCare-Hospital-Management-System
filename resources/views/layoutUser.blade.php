<!DOCTYPE html>
<html lang="en">
<head>
@include('userTemplate.shard.head')
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>

    <header class="main-header">
        <!--Header Top-->
        @include('userTemplate.shard.navBar')
        @yield('content')
  
 

<!--Scroll to top-->
@include('userTemplate.shard.scripts')

</body>
</html>