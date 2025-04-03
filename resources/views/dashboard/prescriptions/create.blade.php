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
                                            <p class="mb-1"><strong>{{ __('Doctor') }}:</strong> Dr.
                                                {{ $appointment->doctor->name }}</p>
                                            <p class="mb-1"><strong>{{ __('Patient') }}:</strong>
                                                {{ $appointment->patient->name }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>{{ __('Date') }}:</strong>
                                                {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}</p>
                                            <p class="mb-1"><strong>{{ __('Time') }}:</strong>
                                                {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</p>
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
                                <textarea name="description" class="form-control" id="inputNotes" rows="4"
                                    placeholder="{{ __('Enter prescription details, medications, and instructions...') }}" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-check ml-2">
                                <input class="form-check-input" value="true" type="checkbox" id="addLabTest"
                                    name="add_lab_test">
                                <label class="form-check-label" for="addLabTest">
                                    {{ __('Add Lab Test') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="labTestForm" style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $appointment->patient->name ?? '' }}"
                                        class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="" @readonly(true)>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone_number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="national_id">National ID</label>
                                    <input type="text" class="form-control" id="national_id" name="identity_number">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lab_type_id">Required Test</label>
                                    <select class="form-control" id="lab_type_id" name="lab_type_id">
                                        <option value="" @readonly(true)>Select Test</option>
                                        @foreach ($labTypes ?? [] as $labType)
                                            <option value="{{ $labType->id }}">{{ $labType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    @push('scripts')
                        <script>
                            document.getElementById('addLabTest').addEventListener('change', function() {
                                const labTestForm = document.getElementById('labTestForm');
                                const formInputs = labTestForm.querySelectorAll('input, select');

                                if (this.checked) {
                                    labTestForm.style.display = 'block';
                                    formInputs.forEach(input => input.setAttribute('required', ''));
                                } else {
                                    labTestForm.style.display = 'none';
                                    formInputs.forEach(input => input.removeAttribute('required'));
                                }
                            });
                        </script>
                    @endpush
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
