@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <form action={{ route('user.create') }} method="get">
        @csrf
        <button type="submit" class="btn btn-success ml-3 my-3"> Add new user </button>
    </form>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0 mb-2">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">All Users</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">List of all system users</p>
            </div>
            <div class="px-3 pt-2 pb-1">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td><strong>{{ $user->name }}</strong></td>
                                    <td><span class="py-1 px-2 rounded bg-info text-sm">{{ $user->role }}</span></td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <form action="{{ route('user.edit', $user->id) }}" method="GET">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn bg-warning mx-2 text-white badge p-2 dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bx bx-edit-alt me-2"></i>Edit
                                                    </button>
                                                </form>
                                                <form action="{{ route('user.destroy', $user->id) }}" class="ml-3"
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
                                    <td colspan="5" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
