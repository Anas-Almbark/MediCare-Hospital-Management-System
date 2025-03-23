@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">{{ __('Appointments') }}</h5>
                    <a href="{{ route('appointment.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> {{ __('New') }}
                    </a>
                </div>
                
                <form action="{{ route('appointment.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Filter by Date') }}</label>
                        <input type="date" name="appointment_date" class="form-control" value="{{ request('appointment_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Doctor') }}</label>
                        <select name="doctor_id" class="form-select">
                            <option value="">{{ __('All Doctors') }}</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Status') }}</label>
                        <select name="status" class="form-select">
                            <option value="">{{ __('All Status') }}</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>{{ __('Available') }}</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-secondary me-2">
                            <i class="fas fa-filter"></i> {{ __('Filter') }}
                        </button>
                        <a href="{{ route('appointment.index') }}" class="btn btn-light">
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
                                <th>{{ __('Doctor') }}</th>
                                <th>{{ __('Patient') }}</th>
                                <th>{{ __('Day') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->doctor->name }}</td>
                                    <td>{{ $appointment->patient ? $appointment->patient->name : '-' }}</td>
                                    <td>{{ $appointment->day_of_week }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ date('h:i A', strtotime($appointment->start_time)) }} - 
                                            {{ date('h:i A', strtotime($appointment->end_time)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $appointment->status == 'available' ? 'success' : ($appointment->status == 'confirmed' ? 'primary' : 'danger') }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('appointment.show', $appointment->id) }}" class="btn btn-light" title="{{ __('View Details') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($appointment->status == 'available')
                                                <a href="{{ route('appointment.book', $appointment->id) }}" class="btn btn-light" title="{{ __('Book Appointment') }}">
                                                    <i class="fas fa-calendar-check text-success"></i>
                                                </a>
                                            @endif
                                            @if($appointment->status == 'confirmed' && auth()->user()->id == $appointment->patient_id)
                                                <a href="{{ route('appointment.cancel', $appointment->id) }}" class="btn btn-light" 
                                                   onclick="return confirm('{{ __('Are you sure you want to cancel this appointment?') }}')"
                                                   title="{{ __('Cancel Appointment') }}">
                                                    <i class="fas fa-calendar-times text-danger"></i>
                                                </a>
                                            @endif
                                            @hasrole('super-admin')
                                                <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light" 
                                                            onclick="return confirm('{{ __('Are you sure?') }}')"
                                                            title="{{ __('Delete Appointment') }}">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            @endhasrole
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">{{ __('No appointments found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($appointments->hasPages())
                    <div class="p-3">
                        <nav>
                            <ul class="pagination justify-content-center mb-0">
                                {{-- Previous Page Link --}}
                                @if ($appointments->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">«</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $appointments->previousPageUrl() }}" rel="prev">«</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($appointments->getUrlRange(1, $appointments->lastPage()) as $page => $url)
                                    @if ($page == $appointments->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($appointments->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $appointments->nextPageUrl() }}" rel="next">»</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">»</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
