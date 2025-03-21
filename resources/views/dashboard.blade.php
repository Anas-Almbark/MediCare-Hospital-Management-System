<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard/shard.head')
</head>

<body class="main-body app sidebar-mini">
    @include('dashboard.shard.loader')
    <div class="page">
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        @include('dashboard/shard.sideBar')
        <div class="main-content app-content">
            @include('dashboard/shard.navBar')
            <!-- container -->
            @yield('content')
            <!-- /Container -->
        </div>
        <div class="sidebar sidebar-right sidebar-animate">
            <div class="panel panel-primary card mb-0 box-shadow">
                <div class="tab-menu-heading border-0 p-3">
                    <div class="card-title mb-0">Notifications</div>
                    <div class="card-options ml-auto">
                        <a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#side1" class="active" data-toggle="tab"><i
                                        class="ion ion-md-chatboxes tx-18 mr-2"></i> Chat</a></li>
                            <li><a href="#side2" data-toggle="tab"><i class="ion ion-md-notifications tx-18  mr-2"></i>
                                    Notifications</a></li>
                            <li><a href="#side3" data-toggle="tab"><i class="ion ion-md-contacts tx-18 mr-2"></i>
                                    Friends</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        
                        {{-- <div class="tab-pane active" id="side1">
                            @forelse($users as $user)
                            
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">
                                            @if($user->profile_photo_url)
                                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                            @else
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            @endif
                                        </span>
                                    </div>
                                    <a class="wrapper w-100 ml-3" href="{{ route('chatify', ['id' => $user->id]) }}">
                                        <p class="mb-0 d-flex">
                                            <b>{{ $user->name }}</b>
                                        </p>
                                        
                                    </a>
                                </div>
                            @empty
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="text-center w-100">
                                        <p class="mb-0">not users</p>
                                    </div>
                                </div>
                            @endforelse
                        </div> --}}
                        <div class="tab-pane  " id="side2">
                            <div class="list-group list-group-flush ">
                                <div class="list-group-item d-flex  align-items-center">
                                    <div class="mr-3">
                                        <span class="avatar avatar-lg brround cover-image"
                                            data-image-src="../../assets/img/faces/12.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div>
                                        <strong>Madeleine</strong> Hey! there I' am available....
                                        <div class="small text-muted">
                                            3 hours ago
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex  align-items-center">
                                    <div class="mr-3">
                                        <span class="avatar avatar-lg brround cover-image"
                                            data-image-src="../../assets/img/faces/1.jpg"></span>
                                    </div>
                                    <div>
                                        <strong>Anthony</strong> New product Launching...
                                        <div class="small text-muted">
                                            5 hour ago
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex  align-items-center">
                                    <div class="mr-3">
                                        <span class="avatar avatar-lg brround cover-image"
                                            data-image-src="../../assets/img/faces/2.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div>
                                        <strong>Olivia</strong> New Schedule Realease......
                                        <div class="small text-muted">
                                            45 mintues ago
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex  align-items-center">
                                    <div class="mr-3">
                                        <span class="avatar avatar-lg brround cover-image"
                                            data-image-src="../../assets/img/faces/8.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div>
                                        <strong>Madeleine</strong> Hey! there I' am available....
                                        <div class="small text-muted">
                                            3 hours ago
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex  align-items-center">
                                    <div class="mr-3">
                                        <span class="avatar avatar-lg brround cover-image"
                                            data-image-src="../../assets/img/faces/11.jpg"></span>
                                    </div>
                                    <div>
                                        <strong>Anthony</strong> New product Launching...
                                        <div class="small text-muted">
                                            5 hour ago
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex  align-items-center">
                                    <div class="mr-3">
                                        <span class="avatar avatar-lg brround cover-image"
                                            data-image-src="../../assets/img/faces/6.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div>
                                        <strong>Olivia</strong> New Schedule Realease......
                                        <div class="small text-muted">
                                            45 mintues ago
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex  align-items-center">
                                    <div class="mr-3">
                                        <span class="avatar avatar-lg brround cover-image"
                                            data-image-src="../../assets/img/faces/9.jpg"><span
                                                class="avatar-status bg-success"></span></span>
                                    </div>
                                    <div>
                                        <strong>Olivia</strong> Hey! there I' am available....
                                        <div class="small text-muted">
                                            12 mintues ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="side3">
                            {{-- <div class="list-group list-group-flush">
                                @forelse($users as $user)
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="mr-2">
                                            <span class="avatar avatar-md brround cover-image" 
                                                  data-image-src="{{ $user->profile_photo_url ?? asset('assets/img/faces/default.jpg') }}">
                                                @if($user->is_online)
                                                    <span class="avatar-status bg-success"></span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="">
                                            <div class="font-weight-semibold">{{ $user->name }}</div>
                                        </div>
                                        <div class="ml-auto">
                                            <a href="{{ route('chatify', ['id' => $user->id]) }}" class="btn btn-sm btn-light">
                                                <i class="fab fa-facebook-messenger"></i>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="list-group-item text-center">
                                        <p>not users</p>
                                    </div>
                                @endforelse
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard/shard.footer')
    </div>
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
    @include('dashboard/shard.scripts')
    @stack('scripts')
</body>

</html>

