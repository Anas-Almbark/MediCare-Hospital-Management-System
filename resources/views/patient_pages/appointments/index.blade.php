@extends('layoutindex')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Available Appointments') }}</h5>
            
            <form action="{{ route('patient.appointments') }}" method="GET" class="mt-3">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Doctor') }}</label>
                        <select name="doctor_id" class="form-select">
                            <option value="">{{ __('All Doctors') }}</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }} - {{ $doctor->specialization }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Date') }}</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Time of Day') }}</label>
                        <select name="time_of_day" class="form-select">
                            <option value="">{{ __('Any Time') }}</option>
                            <option value="morning" {{ request('time_of_day') == 'morning' ? 'selected' : '' }}>{{ __('Morning') }}</option>
                            <option value="afternoon" {{ request('time_of_day') == 'afternoon' ? 'selected' : '' }}>{{ __('Afternoon') }}</option>
                            <option value="evening" {{ request('time_of_day') == 'evening' ? 'selected' : '' }}>{{ __('Evening') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> {{ __('Search') }}
                        </button>
                        <a href="{{ route('patient.appointments') }}" class="btn btn-light">
                            <i class="fas fa-redo"></i> {{ __('Reset') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="row g-4">
                @forelse($appointments as $appointment)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $appointment->doctor->avatar ?? asset('images/default-avatar.png') }}" 
                                         class="rounded-circle me-3" 
                                         width="50" 
                                         alt="Doctor Avatar">
                                    <div>
                                        <h6 class="mb-1">Dr. {{ $appointment->doctor->name }}</h6>
                                        <p class="text-muted mb-0">{{ $appointment->doctor->specialization }}</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar-day text-primary me-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock text-primary me-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</span>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <a href="{{ route('appointment.book', $appointment->id) }}" 
                                       class="btn btn-primary"
                                       onclick="return confirm('{{ __('Are you sure you want to book this appointment?') }}')">
                                        <i class="fas fa-calendar-check me-2"></i>
                                        {{ __('Book Appointment') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times text-muted mb-3" style="font-size: 3rem;"></i>
                            <h5>{{ __('No available appointments') }}</h5>
                            <p class="text-muted">{{ __('Please try different search criteria or check back later.') }}</p>
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
@endsection