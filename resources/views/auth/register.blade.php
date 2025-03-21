<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.shard.head')
</head>

<body class="main-body">
    @include('dashboard.shard.loader')
    <div class="page">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                    <div class="row wd-100p mx-auto text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="{{ asset('assets/img/hospital.jpg') }}"
                                class="my-auto rounded-lg ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                    <div class="login d-flex align-items-center py-2">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                    <div class="card-sigin">
                                        <div class="mb-5 mt-5 d-flex" style="margin-left: -10px"> <a href="index.html">
                                                <img src="{{ asset('assets/img/logo-v.png') }}"
                                                    class="sign-favicon ht-60" alt="logo">
                                            </a>
                                        </div>
                                        <div class="main-signup-header">
                                            <h2 class="text-primary">Get Started</h2>
                                            <h5 class="font-weight-normal mb-4">It's free to signup and only takes a
                                                minute.</h5>
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <div>
                                                    <x-input-label for="name" :value="__('Name')" />
                                                    <x-text-input id="name" class="block form-control mt-1 w-full"
                                                        type="text" name="name" :value="old('name')" required
                                                        autofocus autocomplete="name" />
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="email" :value="__('Email')" />
                                                    <x-text-input id="email" class="form-control block mt-1 w-full"
                                                        type="email" name="email" :value="old('email')" required
                                                        autocomplete="username" />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>

                                                <!-- Password -->
                                                <div class="mt-4">
                                                    <x-input-label for="password" :value="__('Password')" />

                                                    <x-text-input id="password" class="form-control block mt-1 w-full"
                                                        type="password" name="password" required
                                                        autocomplete="new-password" />

                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>
                                                <div class="mt-4">
                                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                                    <x-text-input id="password_confirmation"
                                                        class="form-control block mt-1 w-full" type="password"
                                                        name="password_confirmation" required
                                                        autocomplete="new-password" />
                                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                </div>

                                                <div class="mt-4">
                                                    <x-primary-button class="block ms-4">
                                                        {{ __('Register') }}
                                                    </x-primary-button>
                                                </div>
                                                
                                                <div class="mt-4">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-2">
                                                            <a href="{{ route('auth.google') }}" class="btn btn-danger btn-block">
                                                                <i class="fab fa-google me-2"></i> Google
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="{{ route('auth.github') }}" class="btn btn-dark btn-block">
                                                                <i class="fab fa-github me-2"></i> GitHub
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="main-signup-footer mt-3">
                                                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a>
                                                </p>
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
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/plugins/ionicons/ionicons.js"></script>
    <script src="../../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../../assets/plugins/moment/moment.js"></script>
    <script src="../../assets/js/eva-icons.min.js"></script>
    <script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>
    <script src="../../assets/plugins/rating/jquery.barrating.js"></script>
    <script src="../../assets/js/custom.js"></script>

</body>

</html>
