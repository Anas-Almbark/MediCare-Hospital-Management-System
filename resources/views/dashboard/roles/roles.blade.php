@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <form action={{ route('role.create') }} method="get">
        @csrf
        <button type="submit" class="btn btn-success ml-3 my-3"> Add new role </button>
    </form>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0 mb-2">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">All Roles</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">List of all system roles</p>
            </div>
            <div class="text-nowrap px-2 pt-1">
                <table class="table mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>name role</th>
                            <th>create at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($roles as $role)
                            <tr>
                                <td>
                                    <strong class="ml-2"> {{ $role->name }} </strong>
                                </td>
                                <td> {{ $role->created_at->diffForHumans() }} </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <form action="{{ route('role.edit', $role->id) }}" method="GET">
                                                @csrf
                                                <button type="submit"
                                                    class="btn bg-warning mx-2 text-white badge p-2 dropdown-item"
                                                    href="javascript:void(0);"><i class="bx bx-edit-alt me-2"></i>
                                                    Edit</button>
                                            </form>
                                            <form action="{{ route('role.destroy', $role->id) }}" class="ml-3"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn bg-danger text-white badge p-2 dropdown-item"
                                                    href="javascript:void(0);"><i class="bx bx-trash me-2"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p> no data </p>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
