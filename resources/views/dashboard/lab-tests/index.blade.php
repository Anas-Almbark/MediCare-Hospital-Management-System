@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0"><i class="fas fa-flask me-2 mx-2"></i>Laboratory Tests Management</h5>
                    <a href="{{ route('lab-test.create') }}" class="btn btn-dark ">
                        <i class="fas fa-plus"></i> Add New Test
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="card border border-primary bg-white shadow-lg mb-3">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-primary p-3 mx-3"
                                    style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-vial text-white"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">{{ $labTests->count() }}</h3>
                                    <p class="mb-0">Total Tests</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card border border-success bg-white shadow-lg mb-3">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-success p-3 mx-3"
                                    style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">{{ $labTests->where('status', 'completed')->count() }}</h3>
                                    <p class="mb-0">Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card border border-warning bg-white shadow-lg mb-3">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-warning p-3 mx-3"
                                    style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">{{ $labTests->where('status', 'pending')->count() }}</h3>
                                    <p class="mb-0">Pending</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card border border-danger bg-white shadow-lg mb-3">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-danger p-3 mx-3"
                                    style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-times text-white"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">{{ $labTests->where('status', 'cancelled')->count() }}</h3>
                                    <p class="mb-0">Cancelled</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="input-group">
                            <form action="{{ route('lab-test.search') }}" class="d-flex w-100">
                                <input type="text" class="form-control" name="search" placeholder="Search by name">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="pr-1 mb-3 mb-xl-0">
                        <button type="button" class="btn btn-info btn-icon mr-2" id="filter-btn">
                            <i class="mdi mdi-filter-variant"></i>
                        </button>
                    </div>
                </div>
                <div id="filter-panel" class="card mb-4 shadow-sm" style="display: none;">
                    <div class="card-body bg-light">
                        <form>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Test Type</label>
                                    <select class="form-control select2-no-search">
                                        <option label="Choose one"></option>
                                        <option value="blood">Blood Test</option>
                                        <option value="urine">Urine Test</option>
                                        <option value="imaging">Imaging</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <p class="mg-b-10">Status</p>
                                    <select class="form-control select2-no-search">
                                        <option label="Choose one">
                                        </option>
                                        <option value="">
                                            All Statuses
                                        </option>
                                        <option value="pending">
                                            Pending
                                        </option>
                                        <option value="completed">
                                            Completed
                                        </option>
                                        <option value="cancelled">
                                            Cancelled
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">From Date</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">To Date</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-12 text-end">
                                    <button type="reset" class="btn btn-secondary btn-sm me-2">
                                        <i class="fas fa-redo me-1"></i> Reset
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="fas fa-check me-1"></i> Apply Filters
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive border rounded">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th class="py-3"> Patient Name</th>
                                <th class="py-3">Test Type</th>
                                <th class="py-3">Test Price</th>
                                <th class="py-3">Doctor</th>
                                <th class="py-3">Date</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Results</th>
                                <th class="py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($labTests as $labTest)
                                <tr>
                                    <td>{{ $labTest->patientData->name }}</td>
                                    <td>{{ $labTest->labType->name }}</td>
                                    <td>${{ $labTest->labType->price }}</td>
                                    <td>{{ $labTest->doctorData->name ?? 'N/A' }}</td>
                                    <td>{{ $labTest->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if ($labTest->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($labTest->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($labTest->status == 'completed')
                                            <a href="{{ route('lab-test.show', $labTest->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-file-medical"></i> View
                                            </a>
                                            <a href="#" class="btn btn-sm btn-success">
                                                <i class="fab fa-whatsapp"></i> Send
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('lab-test.edit', $labTest->id) }}" method='GET'>
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-warning btn-sm me-1 mr-2"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('lab-test.destroy', $labTest->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No lab tests found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    {{ $labTests->links() }}
                </div>
                <div class="mt-4 mb-4 border-top pt-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-bar mx-2"></i>Most Commonly Used Tests</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($labTypes as $index => $test)
                                <div class="col-md-4 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div
                                                    class="rounded-circle bg-{{ ['primary', 'success', 'info', 'warning', 'danger'][$index % 5] }}-light p-3 me-3">
                                                    <i
                                                        class="fas fa-{{ ['vial', 'flask', 'x-ray', 'brain', 'heartbeat'][$index % 5] }} text-{{ ['primary', 'success', 'info', 'warning', 'danger'][$index % 5] }} fa-lg"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-0">{{ $test->name }}</h6>
                                                    <span
                                                        class="text-muted small">{{ $labTests->pluck('labType')->where('name', $test->name)->count() }}
                                                        patients</span>
                                                </div>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-{{ ['primary', 'success', 'info', 'warning', 'danger'][$index % 5] }}"
                                                    role="progressbar" style="width: {{ rand(30, 95) }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-chart-pie me-1"></i> View Full Analytics
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#filter-btn').on('click', function() {
                    $('#filter-panel').slideToggle();
                });

                // Initialize tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            });
        </script>
    @endpush
@endsection
