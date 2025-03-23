@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">{{ __('Edit Doctor Schedule') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('doctor-schedules.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">{{ __('Doctor') }}</label>
                        <input type="text" class="form-control" value="{{ $schedule->doctor->name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="day_of_week" class="form-label">{{ __('Day') }}</label>
                        <select name="day_of_week" class="form-control" id="day_of_week" required>
                            @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                <option value="{{ $day }}" {{ $schedule->day_of_week == $day ? 'selected' : '' }}>
                                    {{ __($day) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="start_time" class="form-label">{{ __('Start Time') }}</label>
                        <input type="time" name="start_time" class="form-control" id="start_time" 
                               value="{{ date('H:i', strtotime($schedule->start_time)) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_time" class="form-label">{{ __('End Time') }}</label>
                        <input type="time" name="end_time" class="form-control" id="end_time" 
                               value="{{ date('H:i', strtotime($schedule->end_time)) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="appointment_duration" class="form-label">{{ __('Appointment Duration (minutes)') }}</label>
                        <select name="appointment_duration" class="form-control" id="appointment_duration" required>
                            @foreach([30, 60, 90] as $duration)
                                <option value="{{ $duration }}" {{ $schedule->appointment_duration == $duration ? 'selected' : '' }}>
                                    {{ $duration }} {{ __('minutes') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctor-schedules.index') }}" class="btn btn-light">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Schedule') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection