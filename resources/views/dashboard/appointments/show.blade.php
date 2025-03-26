@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <div class="container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Appointments</h4>
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Appointment Details</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-info">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
                <div class="pr-1 mb-3 mb-xl-0">
                    <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mb-4">
                            <h2>Appointment Information</h2>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="details-group mb-4">
                                    <h4 class="details-label">Doctor Information</h4>
                                    <div class="details-value">
                                        <h5>{{ $appointment->doctor->name ?? 'N/A'}}</h5>                                        <p>Email: {{ $appointment->doctor()->first()->email }}</p>
                                        <p>Phone: {{ $appointment->doctor->phone?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="details-group mb-4">
                                    <h4 class="details-label">Patient Information</h4>
                                    <div class="details-value">
                                        <h5>{{ $appointment->patient->name ?? 'N/A' }}</h5>
                                        <p>Email: {{ $appointment->patient->email ?? 'N/A' }}</p>
                                        <p>Phone: {{ $appointment->patient->phone_number ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="details-group mb-4">
                                    <h4 class="details-label">Appointment Details</h4>
                                    <div class="details-value">
                                        <p><strong>Date:</strong> {{ $appointment->date }}</p>
                                        <p><strong>start_time:</strong> {{ $appointment->start_time }}</p>
                                        <p><strong>end_time:</strong> {{ $appointment->end_time }}</p>
                                        <p><strong>day_of_week:</strong> {{ $appointment->day_of_week }}</p>
                                        <p><strong>Status:</strong> 
                                            <span class="badge badge-{{ $appointment->status == 'pending' ? 'warning' : ($appointment->status == 'confirmed' ? 'success' : 'danger') }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="details-group">
                                    <h4 class="details-label">Notes</h4>
                                    <div class="details-value">
                                        <p>{{ $appointment->notes ?? 'NO NOTES YEET' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="mt-4">
                            @if(auth()->user()->hasRole('doctor'))
                                <a href="{{ route('doctor.appointments.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Appointments List
                                </a>
                            @else
                                <a href="{{ route('appointment.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Appointments List
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection