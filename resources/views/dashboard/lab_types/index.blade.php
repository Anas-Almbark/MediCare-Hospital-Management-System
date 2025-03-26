@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ __('Laboratory') }}</h4>
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Test Types') }}</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-info btn-icon mr-2" id="filter-btn">
                        <i class="mdi mdi-filter-variant"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card mg-b-20" id="filter-panel" style="display: none;">
            <div class="card-body">
                <div class="row align-items-center">
                    <form action="{{ route('lab-type.index') }}" class="d-flex align-items-center w-100" method="GET">
                        @csrf
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Price Range') }}</label>
                                <div class="d-flex">
                                    <input type="number" name="fromRange" class="form-control mr-2" id="price-min"
                                        placeholder="Min" required>
                                    <input type="number" name="toRange" class="form-control" id="price-max"
                                        placeholder="Max" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary btn-block mt-3">{{ __('Apply Filters') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-md-6 col-lg-3">
                <div class="card bg-primary-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="icon1 mt-2">
                                    <i class="fa fa-flask"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="mt-0 text-center">
                                    <span class="text-white">{{ __('Total Tests') }}</span>
                                    <h2 class="text-white mb-0">{{ $labTypes->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card bg-danger-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="icon1 mt-2">
                                    <i class="fa fa-money-bill-alt"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="mt-0 text-center">
                                    <span class="text-white">{{ __('Average Price') }}</span>
                                    <h2 class="text-white mb-0">${{ number_format($labTypes->avg('price') ?? 0, 2) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card bg-success-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="icon1 mt-2">
                                    <i class="fa fa-calendar-check"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="mt-0 text-center">
                                    <span class="text-white">{{ __('Recent Tests') }}</span>
                                    <h2 class="text-white mb-0">
                                        {{ $labTypes->where('created_at', '>=', now()->subDays(7))->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 text-white">{{ __('Laboratory Test Types') }}</h4>
                        <a href="{{ route('lab-type.create') }}" class="btn btn-light">
                            <i class="fa fa-plus"></i> {{ __('Add New Test Type') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">{{ __('Test Name') }}</th>
                                        <th class="border-bottom-0">{{ __('Price') }}</th>
                                        <th class="border-bottom-0">{{ __('Created At') }}</th>
                                        <th class="border-bottom-0 noExport">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($labTypes as $labType)
                                        <tr>
                                            <td>{{ $labType->name }}</td>
                                            <td>${{ number_format($labType->price, 2) }}</td>
                                            <td>{{ $labType->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                        type="button">
                                                        <i class="fas fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu tx-13">
                                                        <a class="dropdown-item"
                                                            href="{{ route('lab-type.edit', $labType->id) }}">
                                                            <i class="fas fa-edit text-primary"></i> {{ __('Edit') }}
                                                        </a>
                                                        <form action="{{ route('lab-type.destroy', $labType->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fas fa-trash text-danger"></i>
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                {{ __('No laboratory test types found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($labTypes->hasPages())
                            <div class="mt-4">
                                {{ $labTypes->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container closed -->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#filter-btn').on('click', function() {
                    $('#filter-panel').slideToggle();
                });
            });
        </script>
    @endpush
@endsection
