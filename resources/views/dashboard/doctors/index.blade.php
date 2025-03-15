@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <form action={{ route('doctor.create') }} method="get">
        @csrf
        <button type="submit" class="btn btn-success ml-3 my-3"> Add new doctor </button>
    </form>
    <div class="col-xl-12">
        <div class="d-flex align-items-center justify-content-between">
            <div class="input-group mb-3">
                <form action="{{ route('doctor.search') }}" class="w-50 d-flex" method="GET">
                    @csrf
                    <input type="search" value="{{ request('name') }}" class="form-control py-1 px-3" name="search"
                        placeholder="Search doctor..." aria-label="Search">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>
            </div>
            <div class="filter mb-3 ms-3">
                <form action="{{ route('doctor.filter') }}" method="GET" class="d-inline">
                    @csrf
                    <select
                        class="form-select btn text-left py-3 px-3 border rounded-lg shadow-sm hover:border-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200"
                        id="specialtyFilter" name="specialty" style="min-width: 200px; background-color: #fff;"
                        onchange="this.form.submit()">
                        <option value="" class="py-1">All Specialties</option>
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty }}"
                                {{ request('specialty') == $specialty ? 'selected' : '' }}>
                                {{ $specialty }}
                            </option>`
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0 mb-2">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">All Doctors</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">List of all hospital doctors</p>
            </div>
            <div class="px-3 pt-2 pb-1">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Specialty</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doctors as $doctor)
                                <tr>
                                    <th scope="row">{{ $doctor->id }}</th>
                                    <td><strong>{{ $doctor->name }}</strong></td>
                                    <td><span class="py-1 px-2 rounded bg-info text-sm">
                                            {{ $doctor->specialty ?? 'Not specified' }}</span></td>
                                    <td>{{ $doctor->phone }}</td>
                                    <td>{{ $doctor->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <form action="{{ route('doctor.edit', $doctor->id) }}" method="GET">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn bg-warning mx-2 text-white badge p-2 dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bx bx-edit-alt me-2"></i>Edit
                                                    </button>
                                                </form>
                                                <form action="{{ route('doctor.destroy', $doctor->id) }}" class="ml-3"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn bg-danger text-white badge p-2 dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bx bx-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No doctors found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
