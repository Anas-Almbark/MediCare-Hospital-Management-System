@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <form action="{{ route('bill.create') }}" method="get">
        @csrf
        <button type="submit" class="btn btn-success ml-3 my-3"> Add new bill </button>
    </form>
    <div class="col-xl-12">
        <div class="d-flex align-items-center justify-content-between">
            <div class="input-group mb-3">
                <form action="{{ '#' }}" class="w-50 d-flex" method="GET">
                    @csrf
                    <input type="search" value="" class="form-control py-1 px-3" name="search"
                        placeholder="Search bills..." aria-label="Search">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0 mb-2">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">All Bills</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">List of all hospital bills</p>
            </div>
            <div class="text-nowrap px-2 pt-1">
                <table class="table mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Amount</th>
                            <th>Details</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($bills as $bill)
                            <tr>
                                <td><strong class="ml-3">{{ $loop->iteration }}</strong></td>
                                <td>{{ App\Models\User::find($bill->doctor)->name }}</td>
                                <td>{{ App\Models\User::find($bill->patient)->name }}</td>
                                <td>${{ number_format($bill->amount, 2) }}</td>
                                <td>{{ $bill->description }}</td>
                                <td>{{ Str::limit($bill->created_at, 30) }}</td>
                                <td>{{ $bill->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="d-flex">
                                        <form action="{{ route('bill.edit', $bill->id) }}" method="GET">
                                            @csrf
                                            <button type="submit"
                                                class="btn bg-warning text-white badge p-2 dropdown-item">
                                                <i class="bx bx-edit-alt me-2"></i> Edit
                                            </button>
                                        </form>
                                        <form action="{{ route('bill.destroy', $bill->id) }}" class="ml-3"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-danger text-white badge p-2 dropdown-item"
                                                onclick="return confirm('Are you sure you want to delete this bill?')">
                                                <i class="bx bx-trash me-2"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No bills found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
