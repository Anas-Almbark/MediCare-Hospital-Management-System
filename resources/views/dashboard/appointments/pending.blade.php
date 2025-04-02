@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">{{ __('Pending Appointments') }}</h5>
                        <p class="text-muted mb-0">{{ __('Review and manage appointment requests') }}</p>
                    </div>
                    <a href="{{ route('doctor.appointments.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Back to All Appointments') }}
                    </a>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('Patient') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Notes') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingAppointments as $appointment)
                                <tr>
                                    <td>
                                        <div>
                                            <strong>{{ $appointment->patient->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $appointment->patient->email }}</small>
                                        </div>
                                    </td>
                                    <td><strong>{{ $appointment->day_of_week }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $appointment->date }}</small>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</strong>
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</small>
                                    </div>
                                </td>
                                    <td>{{ $appointment->notes ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $appointment->id }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $appointment->id }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>

                                        <!-- Confirm Modal -->
                                        <div class="modal fade" id="confirmModal{{ $appointment->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('appointment.update-status', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="confirmed">
                                                        <input type="hidden" name="patient_id" value="{{ $appointment->patient->id }}">
                                                        <input type="hidden" name="send_notification" value="1">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('Confirm Appointment') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="notes" class="form-label">{{ __('Add Note (Optional)') }}</label>
                                                                <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="{{ __('Enter any additional notes...') }}">{{ old('notes', $appointment->notes) }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                            <button type="submit" class="btn btn-success">{{ __('Confirm Appointment') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Reject Modal -->
                                        <div class="modal fade" id="rejectModal{{ $appointment->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('appointment.update-status', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('Reject Appointment') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="reject_notes" class="form-label">{{ __('Rejection Reason (Optional)') }}</label>
                                                                <textarea id="reject_notes" name="notes" class="form-control" rows="3" placeholder="{{ __('Enter reason for rejection...') }}">{{ old('notes', $appointment->notes) }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __('Reject Appointment') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3">{{ __('No pending appointments found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($pendingAppointments->hasPages())
                    <div class="p-3">
                        {{ $pendingAppointments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection