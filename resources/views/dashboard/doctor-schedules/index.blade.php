@extends('dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .nav-tabs .nav-link {
            color: #6c757d;
            border: none;
            border-bottom: 2px solid transparent;
            padding: 0.5rem 1rem;
        }
        
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
            background: none;
        }
        
        .nav-tabs .nav-link:hover {
            border-color: transparent;
            border-bottom: 2px solid #0d6efd;
        }
    </style>
@endpush

@section('content')
    @include('dashboard.shard.successMsg')
    
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">{{ __('Doctor Schedules') }}</h5>
                    <a href="{{ route('doctor.schedules.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> {{ __('Add Schedule') }}
                    </a>
                </div>
                
                <!-- Days Tabs -->
                <ul class="nav nav-tabs mt-3">
                    @php
                        $today = \Carbon\Carbon::now()->format('l');
                        $currentDay = request('day', $today);
                    @endphp
                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <li class="nav-item">
                            <a class="nav-link {{ $currentDay == $day ? 'active' : '' }}"
                               href="{{ route('doctor.schedules.index', ['day' => $day]) }}">
                                {{ __($day) }}
                                @if($day == $today)
                                    <span class="badge bg-primary rounded-pill ms-1">{{ __('Today') }}</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('Doctor Name') }}</th>
                                <th>{{ __('Day') }}</th>
                                <th>{{ __('Start Time') }}</th>
                                <th>{{ __('End Time') }}</th>
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        
                        
                        <tbody>
                            @hasrole('super-admin')
                                @forelse($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->doctor->name }}</td>
                                        <td>{{ $schedule->day_of_week }}</td>
                                        <td>{{ date('h:i A', strtotime($schedule->start_time)) }}</td>
                                        <td>{{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                                        <td>{{ $schedule->appointment_duration }} {{ __('minutes') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('doctor.schedules.show', $schedule->id) }}" class="btn btn-light" title="{{ __('View Appointments') }}">
                                                    <i class="fas fa-calendar-check text-info"></i>
                                                </a>
                                                <a href="{{ route('doctor.schedules.edit', $schedule->id) }}" class="btn btn-light" title="{{ __('Edit Schedule') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('doctor.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light" onclick="return confirm('{{ __('Are you sure?') }}')" title="{{ __('Delete Schedule') }}">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-3">{{ __('No schedules found') }}</td>
                                    </tr>
                                @endforelse
                            @else
                                @forelse($schedules->where('doctor_id', auth()->id()) as $schedule)
                                    <tr>
                                        <td>{{ $schedule->doctor->name }}</td>
                                        <td>{{ $schedule->day_of_week }}</td>
                                        <td>{{ date('h:i A', strtotime($schedule->start_time)) }}</td>
                                        <td>{{ date('h:i A', strtotime($schedule->end_time)) }}</td>
                                        <td>{{ $schedule->appointment_duration }} {{ __('minutes') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('doctor.schedules.show', $schedule->id) }}" class="btn btn-light" title="{{ __('View Appointments') }}">
                                                    <i class="fas fa-calendar-check text-info"></i>
                                                </a>
                                                <a href="{{ route('doctor.schedules.edit', $schedule->id) }}" class="btn btn-light" title="{{ __('Edit Schedule') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('doctor.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light" onclick="return confirm('{{ __('Are you sure?') }}')" title="{{ __('Delete Schedule') }}">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-3">{{ __('No schedules found') }}</td>
                                    </tr>
                                @endforelse
                            @endhasrole
                        </tbody>
                    </table>
                </div>
                @if(isset($schedules) && method_exists($schedules, 'hasPages') && $schedules->hasPages())
                    <div class="p-3">
                        {{ $schedules->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection