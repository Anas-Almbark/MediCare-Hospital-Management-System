@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0">{{ __('Add Doctor Schedule') }}</h5>
                    <a href="{{ route('doctor.schedules.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('doctor.schedules.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="doctor_id" class="form-label">{{ __('Doctor Name') }}</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                <input type="hidden" name="doctor_id" value="{{ auth()->id() }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">{{ __('Date') }}</label>
                                <input type="date" name="date" id="date" class="form-control" required 
                                       min="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="day_of_week" class="form-label">{{ __('Day of Week') }}</label>
                                <input type="text" class="form-control" id="day_display" readonly>
                                <input type="hidden" name="day_of_week" id="day_of_week">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="start_time" class="form-label">{{ __('Start Time') }}</label>
                                <input name="start_time" type="time" class="form-control" id="start_time" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="end_time" class="form-label">{{ __('End Time') }}</label>
                                <input name="end_time" type="time" class="form-control" id="end_time" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="appointment_duration" class="form-label">{{ __('Appointment Duration') }}</label>
                                <select name="appointment_duration" class="form-select" id="appointment_duration" required>
                                    <option value="30">30 {{ __('minutes') }}</option>
                                    <option value="60">60 {{ __('minutes') }}</option>
                                    <option value="90">90 {{ __('minutes') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('Save Schedule') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('date').addEventListener('change', function() {
        const date = new Date(this.value);
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const dayName = days[date.getDay()];
        document.getElementById('day_display').value = dayName;
        document.getElementById('day_of_week').value = dayName;
    });
</script>
@endpush