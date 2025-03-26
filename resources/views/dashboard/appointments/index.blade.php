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
            </div>
            
            <div class="card-body">
                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3">
                    @foreach($appointmentDays as $day)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" 
                               data-bs-toggle="tab" 
                               href="#day-{{ $day }}"
                               role="tab">
                                {{ $day }}
                                <span class="badge bg-primary ms-1">
                                    {{ $appointments->where('day_of_week', $day)->count() }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    @foreach($appointmentDays as $day)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                             id="day-{{ $day }}" 
                             role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Time') }}</th>
                                            <th>{{ __('Doctor') }}</th>
                                            <th>{{ __('Patient') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments->where('day_of_week', $day)->sortBy('start_time') as $appointment)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        {{ date('h:i A', strtotime($appointment->start_time)) }} - 
                                                        {{ date('h:i A', strtotime($appointment->end_time)) }}
                                                    </span>
                                                </td>
                                                <td>{{ $appointment->doctor->name }}</td>
                                                <td>{{ $appointment->patient ? $appointment->patient->name : '-' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $appointment->status == 'available' ? 'success' : ($appointment->status == 'confirmed' ? 'primary' : 'danger') }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <!-- Existing action buttons -->
                                                        @include('dashboard.appointments.partials.actions', ['appointment' => $appointment])
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-3">
                                                    {{ __('No appointments for this day') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
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

@endsection
