@extends('layoutindex')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">{{ __('Available Appointments') }}</h5>
                <div class="date-picker-wrapper">
                    <div class="text-end mb-3">
                        <a href="{{ route('patient.appointments.my') }}" class="btn btn-info">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ __('My Appointments') }}
                        </a>
                    </div>
                    <form action="{{ route('patient.appointments.available') }}" method="GET" class="d-flex align-items-center">
                        <input type="date" 
                               name="date" 
                               class="form-control me-2" 
                               value="{{ $currentDate }}"
                               min="{{ now()->format('Y-m-d') }}"
                               max="{{ now()->addMonths(3)->format('Y-m-d') }}"
                               onchange="this.form.submit()">
                    </form>
                </div>
            </div>
            <div class="selected-date text-primary">
                <i class="fas fa-calendar-day me-2"></i>
                {{ \Carbon\Carbon::parse($currentDate)->format('l, F j, Y') }}
            </div>
        </div>

        <div class="card-body">
            <div class="row g-4">
                @forelse($appointments->groupBy('doctor_id') as $doctorAppointments)
                    @php
                        $doctor = $doctorAppointments->first()->doctor;
                    @endphp
                    <div class="col-12 mb-4">
                        <div class="doctor-section">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $doctor->avatar ?? asset('images/default-avatar.png') }}" 
                                     class="rounded-circle border border-primary" 
                                     width="60" height="60"
                                     alt="Dr. {{ $doctor->name }}">
                                <div class="ms-3">
                                    <h5 class="mb-1">Dr. {{ $doctor->name }}</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-stethoscope me-1"></i>
                                        {{ $doctor->specialization }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="time-slots">
                                <div class="row g-3">
                                    
                                    @foreach($doctorAppointments as $appointment)
                                        <div class="col-md-3">
                                            <div class="time-slot-card card border-0 shadow-sm h-100">
                                                <div class="card-body">
                                                    <div class="time-display text-center mb-3">
                                                        <h4 class="mb-0">{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</h4>
                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</small>
                                                    </div>
                                                    <form action="{{ route('appointment.book', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="btn btn-primary w-100"
                                                                onclick="return confirm('{{ __('Are you sure you want to book this appointment?') }}')">
                                                            <i class="fas fa-calendar-check me-1"></i>
                                                            {{ __('Book') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times text-muted mb-4" style="font-size: 4rem;"></i>
                            <h5 class="fw-bold">{{ __('No available appointments') }}</h5>
                            <p class="text-muted">{{ __('Please try another date') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($appointments->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .time-slot-card {
        transition: transform 0.2s;
    }
    .time-slot-card:hover {
        transform: translateY(-3px);
    }
    .doctor-section {
        border-bottom: 1px solid #eee;
        padding-bottom: 2rem;
    }
    .doctor-section:last-child {
        border-bottom: none;
    }
    .selected-date {
        font-size: 1.1rem;
        font-weight: 500;
    }
</style>
@endpush
@endsection