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
                    </div>
                </div>

                <div class="filters-section mb-3">
                    <form action="{{ route('patient.appointments.available') }}" method="GET" class="row g-3">
                        <!-- Date Filter -->
                        <div class="col-md-5">
                            <label class="form-label">{{ __('Date') }}</label>
                            <input type="date" name="date" class="form-control" value="{{ $currentDate }}"
                                min="{{ now()->format('Y-m-d') }}" max="{{ now()->addMonths(3)->format('Y-m-d') }}">
                        </div>

                        <!-- Doctor Filter -->
                        <div class="col-md-5">
                            <label class="form-label">{{ __('Doctor') }}</label>
                            <select name="doctor_id" class="form-select">
                                <option value="">{{ __('All Doctors') }}</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter me-1"></i>
                                {{ __('Filter') }}
                            </button>
                        </div>
                    </form>
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
                                        class="rounded-circle border border-primary" width="60" height="60"
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

                                        @foreach ($doctorAppointments as $appointment)
                                            <div class="col-md-3">
                                                <div class="time-slot-card card border-0 shadow-sm h-100">
                                                    <div class="card-body">
                                                        <div class="time-display text-center mb-3">
                                                            <h4 class="mb-0">
                                                                {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                                                            </h4>
                                                            <small
                                                                class="text-muted">{{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</small>
                                                            <div class="appointment-details mt-2">
                                                                <span class="badge bg-light text-dark mb-2">
                                                                    <i class="fas fa-clock me-1"></i>
                                                                    {{ \Carbon\Carbon::parse($appointment->start_time)->diffInMinutes($appointment->end_time) }}
                                                                    دقيقة
                                                                </span>
                                                                <div class="doctor-info small text-muted">
                                                                    <div><i class="fas fa-user-md me-1"></i> د.
                                                                        {{ $doctor->name }}</div>
                                                                    @if ($doctor->specialization)
                                                                        <div><i class="fas fa-stethoscope me-1"></i>
                                                                            {{ $doctor->specialization->name }}</div>
                                                                    @endif
                                                                    @if ($doctor->experience_years)
                                                                        <div><i class="fas fa-award me-1"></i>
                                                                            {{ $doctor->experience_years }} سنوات خبرة
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('appointment.book', $appointment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary w-100"
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

                @if ($appointments->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {!! $appointments->appends(request()->query())->onEachSide(1)->links() !!}
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

            .appointment-details {
                border-top: 1px solid #eee;
                padding-top: 0.5rem;
            }

            .doctor-info div {
                margin-bottom: 0.25rem;
            }

            .badge {
                font-weight: normal;
            }

            .filters-section {
                background-color: #f8f9fa;
                padding: 1rem;
                border-radius: 0.5rem;
                margin-bottom: 1rem;
            }

            .form-label {
                font-weight: 500;
                color: #6c757d;
            }

            .form-select,
            .form-control {
                border-color: #dee2e6;
            }

            .form-select:focus,
            .form-control:focus {
                border-color: #86b7fe;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            }

            .pagination {
                margin-bottom: 0;
            }

            .page-link {
                color: #0d6efd;
                padding: 0.5rem 1rem;
                transition: all 0.2s;
            }

            .page-link:hover {
                background-color: #e9ecef;
                border-color: #dee2e6;
                color: #0a58ca;
            }

            .page-item.active .page-link {
                background-color: #0d6efd;
                border-color: #0d6efd;
                color: white;
            }

            .page-item.disabled .page-link {
                color: #6c757d;
                pointer-events: none;
                background-color: #fff;
                border-color: #dee2e6;
            }
        </style>
    @endpush
@endsection
