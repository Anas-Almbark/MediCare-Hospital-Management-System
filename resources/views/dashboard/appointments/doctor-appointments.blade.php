@extends('dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="card-title mb-1">{{ __("Today's Appointments") }}</h5>
                        <p class="text-muted mb-0">{{ __('View and manage your appointments for') }} {{ now()->format('l, F j, Y') }}</p>
                    </div>
                </div>
                
                <form action="{{ route('appointments.doctor') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Filter by Date') }}</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Status') }}</label>
                        <select name="status" class="form-select">
                            <option value="">{{ __('All Status') }}</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Time Range') }}</label>
                        <select name="time_range" class="form-select">
                            <option value="all" {{ request('time_range') == 'all' ? 'selected' : '' }}>{{ __('All Time') }}</option>
                            <option value="morning" {{ request('time_range') == 'morning' ? 'selected' : '' }}>{{ __('Morning') }}</option>
                            <option value="afternoon" {{ request('time_range') == 'afternoon' ? 'selected' : '' }}>{{ __('Afternoon') }}</option>
                            <option value="evening" {{ request('time_range') == 'evening' ? 'selected' : '' }}>{{ __('Evening') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter"></i> {{ __('Filter') }}
                        </button>
                        <a href="{{ route('appointments.doctor') }}" class="btn btn-light">
                            <i class="fas fa-redo"></i> {{ __('Reset') }}
                        </a>
                    </div>
                </form>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Patient') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Notes') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                                <tr class="appointment-row {{ $appointment->status }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2 {{ \Carbon\Carbon::parse($appointment->start_time)->isPast() ? 'text-danger' : 'text-success' }}">
                                                <i class="fas fa-circle fs-xs"></i>
                                            </span>
                                            <div>
                                                <strong>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</strong>
                                                <br>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @if($appointment->patient)
                                                <strong>{{ $appointment->patient->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $appointment->patient->email }}</small>
                                            @else
                                                <span class="text-muted">{{ __('No patient assigned') }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($appointment->notes, 30) }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('appointment.show', $appointment->id) }}" 
                                               class="btn btn-light" title="{{ __('View Details') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($appointment->status != 'cancelled')
                                                <a href="{{ route('prescription.create', ['appointment' => $appointment->id]) }}" 
                                                   class="btn btn-light" title="{{ __('Create Prescription') }}">
                                                    <i class="fas fa-prescription"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-danger" 
                                                        onclick="cancelAppointment({{ $appointment->id }})"
                                                        title="{{ __('Cancel Appointment') }}">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3">{{ __('No appointments found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($appointments->hasPages())
                    <div class="p-3">
                        {{ $appointments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function cancelAppointment(appointmentId) {
            if (confirm("{{ __('Are you sure you want to cancel this appointment?') }}")) {
                window.location.href = `{{ url('appointments') }}/${appointmentId}/cancel`;
            }
        }

        function filterAppointments(filter) {
            window.location.href = `{{ route('appointments.doctor') }}?filter=${filter}`;
        }
    </script>
    @endpush

    @push('styles')
    <style>
        .fs-xs { font-size: 8px; }
        .appointment-row.cancelled { background-color: #fff5f5; }
        .appointment-row.confirmed { background-color: #f0fff4; }
    </style>
    @endpush
@endsection