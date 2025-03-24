@extends('dashboard')
@section('content')
    <div class="mt-4 ml-4">
        <form action="{{ route('staticSalaries.create') }}" method="GET">
            @csrf
            <button class="ml-1 btn btn-success my-3"> add new static salary </button>
        </form>
        <div class="d-flex w-100">
            <div class="card mr-4">
                <div class="card-header border-bottom-0 pb-0">
                    <h3 class="card-title">Employee Static Salaries Comparison</h3>
                </div>
                <div class="card-body p-3">
                    <table class="table card-table salary-table mb-0">
                        <tbody>
                            <tr>
                                <td class="w-1"><i class="fas fa-user-md text-primary fa-2x"></i></td>
                                <td>Senior Doctor
                                    <div class="progress progress-sm mt-1">
                                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                                    </div>
                                </td>
                                <td class="w-1 text-right"><span class="text-muted">$8500</span></td>
                            </tr>
                            <tr>
                                <td class="w-1"><i class="fas fa-user-md text-success fa-2x"></i></td>
                                <td>Specialist Doctor
                                    <div class="progress progress-sm mt-1">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                </td>
                                <td class="text-right"><span class="text-muted">$7000</span></td>
                            </tr>
                            <tr>
                                <td class="w-1"><i class="fas fa-user-nurse text-info fa-2x"></i></td>
                                <td>Head Nurse
                                    <div class="progress progress-sm mt-1">
                                        <div class="progress-bar bg-info" style="width: 70%"></div>
                                    </div>
                                </td>
                                <td class="text-right"><span class="text-muted">$5500</span></td>
                            </tr>
                            <tr>
                                <td class="w-1"><i class="fas fa-user-md text-warning fa-2x"></i></td>
                                <td>General Practitioner
                                    <div class="progress progress-sm mt-1">
                                        <div class="progress-bar bg-warning" style="width: 60%"></div>
                                    </div>
                                </td>
                                <td class="text-right"><span class="text-muted">$4500</span></td>
                            </tr>
                            <tr>
                                <td class="w-1"><i class="fas fa-user-nurse text-pink fa-2x"></i></td>
                                <td>Registered Nurse
                                    <div class="progress progress-sm mt-1">
                                        <div class="progress-bar bg-pink" style="width: 45%"></div>
                                    </div>
                                </td>
                                <td class="text-right"><span class="text-muted">$3500</span></td>
                            </tr>
                            <tr>
                                <td class="w-1"><i class="fas fa-user text-secondary fa-2x"></i></td>
                                <td>Administrative Staff
                                    <div class="progress progress-sm mt-1">
                                        <div class="progress-bar bg-secondary" style="width: 35%"></div>
                                    </div>
                                </td>
                                <td class="text-right"><span class="text-muted">$2800</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card flex-1">
                <div class="card-header">
                    <h3 class="card-title">All Employees Static Salaries</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Static Salary</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($static_salaries as $staticSalary)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $staticSalary->user->name }}</td>
                                        <td>${{ number_format($staticSalary->salary, 2) }}</td>
                                        <td class="d-flex">
                                            <form class="mr-2"
                                                action="{{ route('staticSalaries.edit', $staticSalary->id) }}"
                                                method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('staticSalaries.destroy', $staticSalary->id) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No employees found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
