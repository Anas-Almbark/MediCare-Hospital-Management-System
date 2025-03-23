@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">{{ __('New Appointment') }}</h5>
                        <p class="text-muted mb-0">{{ __('Create a custom appointment slot') }}</p>
                    </div>
                    <a href="{{ route('appointment.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('appointment.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Doctor') }}</label>
                                <select name="doctor" class="form-select" required>
                                    <option value="">-- {{ __('Choose Doctor') }} --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" data-schedule="{{ $doctor->schedules }}">
                                            Dr. {{ $doctor->name }} - {{ $doctor->specialization }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Patient') }}</label>
                                <select name="patient" class="form-select" required>
                                    <option value="">-- {{ __('Select Patient') }} --</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Date') }}</label>
                                <div class="input-group">
                                    <input type="date" name="date" class="form-control" 
                                           min="{{ date('Y-m-d') }}" 
                                           value="{{ old('date', date('Y-m-d')) }}" required>
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Day of Week') }}</label>
                                <input type="text" class="form-control" id="dayOfWeek" readonly>
                                <input type="hidden" name="day_of_week" id="dayOfWeekHidden">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Time') }}</label>
                                <div class="input-group">
                                    <input type="time" name="appointment_time" class="form-control" required>
                                    <span class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Duration') }}</label>
                                <select name="duration" class="form-select" required>
                                    <option value="30">30 {{ __('minutes') }}</option>
                                    <option value="45">45 {{ __('minutes') }}</option>
                                    <option value="60">60 {{ __('minutes') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Status') }}</label>
                                <select name="status" class="form-select" required>
                                    <option value="pending">{{ __('Pending') }}</option>
                                    <option value="confirmed">{{ __('Confirmed') }}</option>
                                    <option value="cancelled">{{ __('Cancelled') }}</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Notes') }}</label>
                                <textarea name="notes" class="form-control" rows="4" 
                                    placeholder="{{ __('Enter appointment details here...') }}"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> {{ __('Create Appointment') }}
                        </button>
                        <a href="{{ route('appointment.index') }}" class="btn btn-light">
                            <i class="fas fa-times me-1"></i> {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr(".flatpickr", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: "today",
                    time_24hr: true,
                    minuteIncrement: 15,
                    locale: {
                        firstDayOfWeek: 1
                    },
                    onChange: function(selectedDates, dateStr, instance) {
                        // You can add custom validation here if needed
                    }
                });
            });
        </script>
    @endpush
@endsection