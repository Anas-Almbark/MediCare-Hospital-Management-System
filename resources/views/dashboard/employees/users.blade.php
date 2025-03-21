@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <form action={{ route('user.create') }} method="get">
        @csrf
        <button type="submit" class="btn btn-success ml-3 my-3">{{ __('Add new user') }}</button>
    </form>
    <div class="col-xl-12">
        <div class="d-flex align-items-center justify-content-between">
            <div class="input-group mb-3">
                <form action="{{ route('user.search') }}" class="w-50 d-flex" method="GET">
                    @csrf
                    <input type="search" value="{{ request('name') }}" class="form-control py-1 px-3" name="search"
                        placeholder="{{ __('Search...') }}" aria-label="{{ __('Search') }}">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>
            </div>
            <div class="filter mb-3 ms-3">
                <form action="{{ route('user.filter') }}" method="GET" class="d-inline">
                    @csrf
                    <select
                        class="form-select btn text-left py-3 px-3 border rounded-lg shadow-sm hover:border-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200"
                        id="roleFilter" name="role" style="min-width: 200px; background-color: #fff;"
                        onchange="this.form.submit()">
                        <option value="" class="py-1">{{ __('All Roles') }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}
                                class="py-1">
                                {{ __($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0 mb-2">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{ __('All Users') }}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">{{ __('List of all system users') }}</p>
            </div>
            <div class="px-3 pt-2 pb-1">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Role') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td><strong>{{ $user->name }}</strong></td>
                                    <td><span class="py-1 px-2 rounded bg-info text-sm">
                                            {{ __($user->roles->first()->name ?? 'No role assigned') }}</span></td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <form action="{{ route('user.edit', $user->id) }}" method="GET">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn bg-warning mx-2 text-white badge p-2 dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bx bx-edit-alt me-2"></i>{{ __('Edit') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('user.destroy', $user->id) }}" class="ml-3"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn bg-danger text-white badge p-2 dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bx bx-trash me-2"></i>{{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('No users found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
