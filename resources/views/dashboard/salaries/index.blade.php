@extends('dashboard')
@section('content')
    <div class="p-4">
        <span class="d-block my-3 ml-1"> Date of today : {{ date('Y-m-d') }}</span>
        <div class="row row-sm">
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-primary-gradient text-white ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-users tx-40"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="mt-0 text-center">
                                    <span class="text-white">Employees</span>
                                    <h2 class="text-white mb-0">{{ $employees->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-danger-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-user-plus tx-40"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="mt-0 text-center">
                                    <span class="text-white">Monthly Payments</span>
                                    <h2 class="text-white mb-0">
                                        {{ $monthlyPayments->count() }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-success-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-user-x tx-40"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="mt-0 text-center">
                                    <span class="text-white">Monthly Unpaid</span>
                                    <h2 class="text-white mb-0">{{ $employees->count() - $monthlyPayments->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-warning-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon1 mt-2 text-center">
                                    <i class="fe fe-pie-chart tx-40"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="mt-0 text-center">
                                    <span class="text-white">Monthly Salaries</span>
                                    <h2 class="text-white mb-0">${{ $monthlySalaries }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <form action="{{ route('salaries.create') }}" method="GET">
                @csrf
                <button class="btn btn-success mb-3"> Add New Record </button>
            </form>
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Salaries Table</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="mt-2 table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Employee Name</th>
                                    <th class="border-bottom-0">Base Salary</th>
                                    <th class="border-bottom-0">Bonus</th>
                                    <th class="border-bottom-0">Deductions</th>
                                    <th class="border-bottom-0">Net Salary</th>
                                    <th class="border-bottom-0">Payment Date</th>
                                    <th class="border-bottom-0"> actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salaries as $salary)
                                    <tr>
                                        <td>{{ $salary->user->name ?? '' }}</td>
                                        <td>${{ number_format($salary->base_salary, 2) }}</td>
                                        <td>${{ number_format($salary->bonus, 2) }}</td>
                                        <td>${{ number_format($salary->deductions, 2) }}</td>
                                        <td>${{ number_format($salary->netSalary(), 2) }}</td>
                                        <td>{{ $salary->payment_date }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @include('dashboard.salaries.delete')
                                                <form class="ml-2" action="{{ route('salaries.edit', $salary->id) }}"
                                                    method="GET">
                                                    @csrf
                                                    <button class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
