@extends('layoutindex')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('My Appointments') }}</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Doctor') }}</th>
                            <th>{{ __('Notes') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Time') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $appointment->doctor->avatar ?? asset('images/default-avatar.png') }}" 
                                             class="rounded-circle me-2" 
                                             width="40" 
                                             alt="Doctor Avatar">
                                        <span>Dr. {{ $appointment->doctor->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $appointment->notes }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</td>
                                <td>
                                    @switch($appointment->status)
                                        @case('pending')
                                            <span class="badge bg-warning">{{ __('Pending') }}</span>
                                            @break
                                        @case('confirmed')
                                            <span class="badge bg-success">{{ __('Confirmed') }}</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">{{ __('Cancelled') }}</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-info">{{ __('Completed') }}</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ $appointment->status }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($appointment->status === 'pending')
                                        <form action="{{ route('patient.appointments.cancel', $appointment->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('Are you sure you want to cancel this appointment?') }}')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-times me-1"></i>
                                                {{ __('Cancel') }}
                                            </button>
                                        </form>
                                    @endif
                                    @if($appointment->status === 'completed')
                                        <a href="{{ route('medical-record.show', $appointment->id) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-file-medical me-1"></i>
                                            {{ __('Medical Record') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-calendar-times text-muted mb-3" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3">{{ __('No appointments found') }}</h5>
                                    <p class="text-muted">{{ __('You have not booked any appointments yet.') }}</p>
                                    <a href="{{ route('patient.appointments') }}" class="btn btn-primary">
                                        <i class="fas fa-calendar-plus me-1"></i>
                                        {{ __('Book an Appointment') }}
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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