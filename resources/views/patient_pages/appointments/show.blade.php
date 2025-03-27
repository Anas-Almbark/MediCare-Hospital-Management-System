@extends('layoutindex')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>{{ __('Appointment Details') }}</h5>
                            <a href="{{route('patient.appointments.my') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-2"></i>{{ __('Back to Appointments') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Appointment Status Card -->
                            <div class="col-md-12 mb-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle p-3 text-white bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }} me-3">
                                                <i class="fas fa-calendar-check text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ __('Status') }}</h6>
                                                <span class="badge text-white bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Doctor Information -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">{{ __('Doctor Information') }}</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar avatar-xl rounded-circle me-3">
                                                <img src="{{ $appointment->doctor->profile_photo_url }}" alt="Doctor Photo">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $appointment->doctor->name }}</h6>
                                                <p class="text-muted mb-0">{{ $appointment->doctor->specialization }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            {{ $appointment->doctor->email }}
                                        </div>
                                        <div>
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            {{ $appointment->doctor->phone }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment Details -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">{{ __('Appointment Details') }}</h6>
                                        <div class="mb-2">
                                            <i class="fas fa-calendar text-primary me-2"></i>
                                            <strong>{{ __('Date') }}:</strong>
                                            {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}
                                        </div>
                                        <div class="mb-2">
                                            <i class="fas fa-clock text-primary me-2"></i>
                                            <strong>{{ __('Time') }}:</strong>
                                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - 
                                            {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                                        </div>
                                        <div class="mb-2">
                                            <i class="fas fa-hourglass-half text-primary me-2"></i>
                                            <strong>{{ __('Duration') }}:</strong>
                                            {{ $appointment->duration }} {{ __('minutes') }}
                                        </div>
                                        @if($appointment->notes)
                                            <div class="mt-3">
                                                <i class="fas fa-notes-medical text-primary me-2"></i>
                                                <strong>{{ __('Notes') }}:</strong>
                                                <p class="mb-0 mt-2">{{ $appointment->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Prescription Information -->
                            @if( $appointment->prescription)
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">
                                            <i class="fas fa-prescription text-primary me-2"></i>
                                            {{ __('Prescription') }}
                                        </h6>
                                        <div class="prescription-content p-3 bg-light rounded">
                                            <div class="mb-3">
                                                <strong>{{ __('Doctor') }}:</strong> 
                                                {{ $appointment->doctor->name }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('Date') }}:</strong> 
                                                {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}
                                            </div>
                                            <div class="prescription-description">
                                                <strong>{{ __('Description') }}:</strong>
                                                <p class="mt-2">{{ $appointment->prescription->description }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('patient.prescriptions.download', $appointment->prescription->id) }}" 
                                               class="btn btn-primary">
                                                <i class="fas fa-download me-2"></i>
                                                {{ __('Download Prescription') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .avatar {
            width: 60px;
            height: 60px;
            overflow: hidden;
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cancelForms = document.querySelectorAll('form[action*="cancel"]');
            
            cancelForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: '{{ __("Are you sure?") }}',
                        text: '{{ __("You won't be able to revert this!") }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: '{{ __("Yes, cancel it!") }}',
                        cancelButtonText: '{{ __("No, keep it") }}'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    @endpush
@endsection