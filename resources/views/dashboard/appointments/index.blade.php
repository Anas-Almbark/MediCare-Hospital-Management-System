@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <form action="{{ route("appointment.create") }}" method="get">
        @csrf
        <button type="submit" class="btn btn-success ml-3 my-3"> Add new appointment </button>
    </form>
<!-- container -->
<div class="container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Advanced ui</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Userlist</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon mr-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!--Row-->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">USERS TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
                </div>
                <div class="card-body">
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-lg-8p"><span>User</span></th>
                                    <th class="wd-lg-20p"><span></span></th>
                                    <th class="wd-lg-20p"><span>Created</span></th>
                                    <th class="wd-lg-20p"><span>Status</span></th>
                                    <th class="wd-lg-20p"><span>Email</span></th>
                                    <th class="wd-lg-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                <tr>
                                    <td>
                                        <img alt="avatar" class="rounded-circle avatar-md mr-2" src="{{ asset('assets/img/faces/1.jpg') }}">
                                    </td>
                                    <td>{{ $appointment->patient()->first()->name }}</td>
                                    <td>
                                        {{ $appointment->date }}
                                    </td>
                                    <td class="text-center">
                                        <span class="label text-muted d-flex">
                                            <div class="dot-label {{ $appointment->status == 'pending' ? 'bg-warning' : ($appointment->status == 'confirmed' ? 'bg-success' : 'bg-danger') }} mr-1"></div>
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#">{{ $appointment->patient()->first()->email }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('appointment.show', $appointment->id) }}" class="btn btn-sm btn-primary">
                                            <i class="las la-search"></i>
                                        </a>
                                        <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-sm btn-info">
                                            <i class="las la-pen"></i>
                                        </a>
                                        <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 mb-2">
                        <div class="d-flex align-items-center justify-content-end">
                            {{ $appointments->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
    <!-- row closed  -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->


@endsection
@push('styles')
<style>
    .pagination {
        margin: 0;
    }
    .page-link {
        padding: 0.375rem 0.75rem;
        color: #0162e8;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    .page-item.active .page-link {
        background-color: #0162e8;
        border-color: #0162e8;
    }
    .page-link:hover {
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>
@endpush
