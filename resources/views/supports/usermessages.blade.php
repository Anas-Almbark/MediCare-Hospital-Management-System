@extends("dashboard")
@section("content")
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
            <div class="container-fluid">
               
<aside class="page-aside">
    <div class="aside-content">
        <div class="aside-header">
            <button class="navbar-toggle" data-target=".aside-nav" data-toggle="collapse" type="button"><span class="icon"><i class="fas fa-caret-down"></i></span></button><span class="title">Mail Service</span>
            <p class="description">Service description</p>
        </div>
        <div class="aside-nav collapse">
            <ul class="nav">
                <li><a href="{{ route('supports.index') }}"><span class="icon"><i class="fas fa-fw fa-inbox"></i></span>Anonemus Inbox<span class="badge badge-primary float-right">{{ $supports->whereNull('user_id')->count() }}</span></a></li>
                <li class="active"><a href="{{ route('supports.usermessages') }}"><span class="icon active"><i class="fas fa-fw fa-inbox"></i></span>Users Inbox<span class="badge badge-primary float-right">{{ $supports->whereNotNull('user_id')->count() }}</span></a></li>
            </ul><span class="title">Labels</span>

            <div class="aside-compose"><a class="btn btn-lg btn-primary btn-block" href="#">Compose Email</a></div>
        </div>
    </div>
</aside>

                <div class="main-content container-fluid p-0">
                    @include("supports.message")
                    <div class="email-inbox-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="email-title"><span class="icon"><i class="fas fa-inbox"></i></span> All Inbox <span class="new-messages">({{ $supports->count() }} new messages)</span> </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="email-search">
                                    <div class="input-group input-search">
                                        <input class="form-control" type="text" placeholder="Search mail..."><span class="input-group-btn">
                                       <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="email-filters">
                        <div class="email-filters-left">
                            <label class="custom-control custom-checkbox be-select-all">
                                <input class="custom-control-input chk_all" type="checkbox" name="chk_all"><span class="custom-control-label"></span>
                            </label>
                            <div class="btn-group">
                                <button class="btn btn-light dropdown-toggle" data-toggle="dropdown" type="button">
                                    With selected <span class="caret"></span></button>
                                <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Mark as rea</a><a class="dropdown-item" href="#">Mark as unread</a><a class="dropdown-item" href="#">Spam</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-light" type="button">Archive</button>
                                <button class="btn btn-light" type="button">Span</button>
                                <button class="btn btn-light" type="button">Delete</button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-light dropdown-toggle" data-toggle="dropdown" type="button">Order by <span class="caret"></span></button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu"><a class="dropdown-item" href="#">Date</a><a class="dropdown-item" href="#">From</a><a class="dropdown-item" href="#">Subject</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Size</a>
                                </div>
                            </div>
                        </div>
                        <div class="email-filters-right"><span class="email-pagination-indicator">1-50 of 253</span>
                            <div class="btn-group email-pagination-nav">
                                <button class="btn btn-light" type="button"><i class="fas fa-angle-left"></i></button>
                                <button class="btn btn-light" type="button"><i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="email-list">

                        @foreach ($supports->whereNotNull('user_id') as $message)
                        <div class="email-list-item {{ $message->is_read ? '' : 'email-list-item--unread' }}">
                            <div class="email-list-actions">
                                <label class="custom-control custom-checkbox">
                                    <input class="custom-control-input checkboxes" type="checkbox" value="1"
                                        id="one"><span class="custom-control-label"></span>
                                </label><a class="favorite {{ $message->is_read ? '' : 'active' }}" href="{{ route('supports.show', $message->id) }}"><span><i
                                            class="fas fa-star"></i></span></a>
                            </div>
                            <a href="{{ route('supports.show', $message->id) }}" class="email-list-detail">
                                <span class="date float-right"><span class="icon"><i class="fas fa-paperclip"></i>
                                    </span>{{ $message->created_at->format('F d, Y h:i A') }}</span>
                                <span class="from">{{ $message->name }}</span>
                                <p class="msg">{{ $message->subject }}</p>
                                <p class="email"><span class="icon"><i class="fas fa-envelope"></i>
                                    </span>{{ $message->email }}</p>
                            </a>
                        </div>
                        
                        @endforeach


                    </div>
                </div>
            </div>
             

    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    {{-- <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> --}}
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/libs/js/main-js.js')}}"></script>
    <script>
    $(document).ready(function() {

        // binding the check all box to onClick event
        $(".chk_all").click(function() {

            var checkAll = $(".chk_all").prop('checked');
            if (checkAll) {
                $(".checkboxes").prop("checked", true);
            } else {
                $(".checkboxes").prop("checked", false);
            }

        });

        // if all checkboxes are selected, then checked the main checkbox class and vise versa
        $(".checkboxes").click(function() {

            if ($(".checkboxes").length == $(".subscheked:checked").length) {
                $(".chk_all").attr("checked", "checked");
            } else {
                $(".chk_all").removeAttr("checked");
            }

        });

    });
    </script>

@endsection
