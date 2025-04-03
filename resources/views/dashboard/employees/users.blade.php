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
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-lg-8p" colspan="2"><span>{{ __('User') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('Created') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('Role') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('status') }}</span></th>
                                    <th class="wd-lg-20p"><span>{{ __('Email') }}</span></th>
                                    <th class="wd-lg-20p">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <img alt="avatar" class="rounded-circle avatar-md"
                                                src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('assets/img/faces/1.jpg') }}">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="block p-2 rounded text-sm bg-info w-fit">
                                                {{ __($user->roles->first()->name ?? 'No role assigned') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div
                                                    class="dot-label {{ $user->status_account === 'active' ? 'bg-success' : ($user->status_account === 'not-active' ? 'bg-warning' : 'bg-danger') }} mr-1">
                                                </div>
                                                <span class="label"> {{ $user->status_account }} </span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#">{{ $user->email }}</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('user.edit', $user->id) }}" method="GET"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info">
                                                    <i class="las la-pen"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="las la-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('No users found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
