@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">{{ __('My Pending Appointments') }}</h5>
                        <p class="text-muted mb-0">{{ __('View your pending appointment requests') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('Doctor') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Notes') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                                <tr>
                                    <td>
                                        <div>
                                            <strong>{{ $appointment->doctor->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $appointment->doctor->email }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ date('h:i A', strtotime($appointment->start_time)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-warning',
                                                'confirmed' => 'bg-success',
                                                'cancelled' => 'bg-danger',
                                                'rejected' => 'bg-danger',
                                                'available' => 'bg-info'
                                            ];
                                        @endphp
                                        <span class="badge {{ $statusClasses[$appointment->status] ?? 'bg-secondary' }}">
                                            {{ __(ucfirst($appointment->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $appointment->notes ?? '-' }}</td>
                                    <td>
                                        @if(in_array($appointment->status, ['confirmed', 'pending']))
                                            <form action="{{ route('appointment.cancel', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('{{ __('Are you sure you want to cancel this appointment?') }}')">
                                                    <i class="fas fa-times"></i> {{ __('Cancel') }}
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">{{ __('No actions available') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">{{ __('No pending appointments found') }}</td>
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
@endsection