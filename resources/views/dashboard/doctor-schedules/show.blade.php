@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0">{{ __('Schedule Details') }}</h5>
                    <a href="{{ route('doctor-schedules.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>{{ __('Doctor') }}: {{ $schedule->doctor->name }}</h6>
                        <h6>{{ __('Day') }}: {{ __($schedule->day_of_week) }}</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>{{ __('Working Hours') }}: {{ date('h:i A', strtotime($schedule->start_time)) }} - {{ date('h:i A', strtotime($schedule->end_time)) }}</h6>
                        <h6>{{ __('Appointment Duration') }}: {{ $schedule->appointment_duration }} {{ __('minutes') }}</h6>
                    </div>
                </div>

                <h5 class="mb-3">{{ __('Available Appointments') }}</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Time Slot') }}</th>
                                <th>{{ __('Patient') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedule->appointments as $appointment)
                                <tr>
                                    <td>
                                        {{ date('h:i A', strtotime($appointment->start_time)) }} - 
                                        {{ date('h:i A', strtotime($appointment->end_time)) }}
                                    </td>
                                    <td>
                                        {{ $appointment->patient ? $appointment->patient->name : '-' }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $appointment->status == 'available' ? 'success' : ($appointment->status == 'confirmed' ? 'primary' : 'danger') }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($appointment->status == 'available')
                                            <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-book"></i> {{ __('Book') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('No appointments found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection