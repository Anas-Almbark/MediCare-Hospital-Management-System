@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <form action="{{ route("prescription.create") }}" method="get">
        @csrf
        <button type="submit" class="btn btn-success ml-3 my-3"> Add new prescription </button>
    </form>
    <div class="col-xl-12">
        <div class="d-flex align-items-center justify-content-between">
            <div class="input-group mb-3">
                <form action="{{"#"}}" class="w-50 d-flex" method="GET">
                    @csrf
                    <input type="search" value="" class="form-control py-1 px-3" name="search"
                        placeholder="Search prescriptions..." aria-label="Search">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0 mb-2">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">All Prescriptions</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">List of all prescriptions</p>
            </div>
            <div class="text-nowrap px-2 pt-1">
                <table class="table mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Dosage</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($prescriptions as $prescription)
                            <tr>
                                <td><strong class="ml-3">{{ $loop->iteration }}</strong></td>
                                <td>{{ $prescription->doctor()->first()->name }}</td>
                                <td>{{ $prescription->patient()->first()->name }}</td>
                                <td>{{ $prescription->description }}</td>
                                <td>{{ $prescription->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('prescription.show', $prescription->id) }}" class="btn btn-sm btn-primary">
                                        <i class="las la-search"></i>
                                    </a>
                                    <a href="{{ route('prescription.edit', $prescription->id) }}" class="btn btn-sm btn-info">
                                        <i class="las la-pen"></i>
                                    </a>
                                    <form action="{{ route('prescription.destroy', $prescription->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this prescription?')">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No prescriptions found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 mb-2">
                <div class="d-flex align-items-center justify-content-end">
                    {{ $prescriptions->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
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
