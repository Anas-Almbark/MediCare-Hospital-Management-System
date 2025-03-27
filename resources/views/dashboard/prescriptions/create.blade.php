@extends('dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">{{ __('New Prescription') }}</h5>
                        <p class="text-muted mb-0">{{ __('Create prescription for appointment') }}</p>
                    </div>
                    <a href="{{ route('doctor.appointments.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('prescription.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Appointment Info Card -->
                        <div class="col-12 mb-4">
                            <div class="card border bg-light">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3">{{ __('Appointment Information') }}</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>{{ __('Doctor') }}:</strong> Dr. {{ $appointment->doctor->name }}</p>
                                            <p class="mb-1"><strong>{{ __('Patient') }}:</strong> {{ $appointment->patient->name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>{{ __('Date') }}:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}</p>
                                            <p class="mb-1"><strong>{{ __('Time') }}:</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Fields -->
                        <input type="hidden" name="doctor" value="{{ $appointment->doctor_id }}">
                        <input type="hidden" name="patient" value="{{ $appointment->patient_id }}">
                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                        
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Prescription Details') }}</label>
                                <textarea name="description" class="form-control" id="inputNotes" 
                                    rows="4" placeholder="{{ __('Enter prescription details, medications, and instructions...') }}" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> {{ __('Create Prescription') }}
                        </button>
                        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-light">
                            <i class="fas fa-times me-1"></i> {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush
@endsection
