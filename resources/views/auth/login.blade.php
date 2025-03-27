<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.shard.head')
</head>

<body class="main-body bg-light">
    @include('dashboard.shard.loader')
    <div class="page">
        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                    <div class="row wd-100p mx-auto text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="{{ asset('assets/img/hospital.jpg') }}"
                                class="my-auto rounded-lg ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                </div>
                <!-- The content half -->
                <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                    <div class="login d-flex align-items-center py-2">
                        <!-- Demo content-->
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                    <div class="card-sigin">
                                        <div class="mb-5 d-flex" style="margin-left: -10px"> <a href="index.html"><img
                                                    src="{{ asset('assets/img/logo-v.png') }}"
                                                    class="sign-favicon ht-60" alt="logo"></a>
                                        </div>
                                        <div class="card-sigin">
                                            <div class="main-signup-header">
                                                <h2>Welcome back!</h2>
                                                <h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf

                                                    <!-- Email Address -->
                                                    <div class="form-group">
                                                        <x-input-label for="email" :value="__('Email')" />
                                                        <x-text-input id="email"
                                                            class="form-control block mt-1 w-full" type="email"
                                                            name="email" :value="old('email')" required autofocus
                                                            autocomplete="username" />
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                    </div>

                                                    <!-- Password -->
                                                    <div class="mt-4 form-group">
                                                        <x-input-label for="password" :value="__('Password')" />
                                                        <x-text-input id="password"
                                                            class="form-control block mt-1 w-full" type="password"
                                                            name="password" required autocomplete="current-password" />

                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                    </div>

                                                    <!-- Remember Me -->
                                                    <div class="block mt-4 form-group">
                                                        <label for="remember_me" class="inline-flex items-center">
                                                            <input id="remember_me" type="checkbox"
                                                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                                name="remember">
                                                            <span
                                                                class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                                        </label>
                                                    </div>

                                                    <div class="mt-4">
                                                        <x-primary-button class="ms-3">
                                                            {{ __('Log in') }}
                                                        </x-primary-button>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <a href="{{ route('auth.google') }}"
                                                                    style="background: #ea4335"
                                                                    class="btn btn-danger btn-block">
                                                                    <i class="fab fa-google me-2"></i> Google
                                                                </a>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <a href="{{ route('auth.github') }}"
                                                                    class="btn btn-dark btn-block">
                                                                    <i class="fab fa-github me-2"></i> GitHub
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @if (session()->has('error'))
                                                    <div class="alert alert-danger mt-3">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                <div class="main-signin-footer mt-4">
                                                    @if (Route::has('password.request'))
                                                        <a class="d-block mb-3 underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                                            href="{{ route('password.request') }}">
                                                            {{ __('Forgot your password?') }}
                                                        </a>
                                                    @endif
                                                    <p>Don't have an account? <a href="{{ route('register') }}">Create
                                                            an
                                                            Account</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End -->
                    </div>
                </div><!-- End -->
            </div>
        </div>

    </div>
    <!-- End Page -->

    <!-- JQuery min js -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Bundle js -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Ionicons js -->
    <script src="../../assets/plugins/ionicons/ionicons.js"></script>

    <!-- Moment js -->
    <script src="../../assets/plugins/moment/moment.js"></script>

    <!-- eva-icons js -->
    <script src="../../assets/js/eva-icons.min.js"></script>

    <!-- Rating js-->
    <script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>
    <script src="../../assets/plugins/rating/jquery.barrating.js"></script>

    <!-- custom js -->
    <script src="../../assets/js/custom.js"></script>

</body>

</html>
