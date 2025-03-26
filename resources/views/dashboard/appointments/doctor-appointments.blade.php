@extends('dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="card-title mb-1">{{ __("Doctor's Appointments") }}</h5>
                        <p class="text-muted mb-0">{{ __('View and manage your appointments') }}</p>
                    </div>
                </div>
            </div>
            <div class="row px-4">
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border border-primary bg-white shadow-lg h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-primary p-3 mx-3"
                                style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-calendar-check text-white"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">
                                    {{ $appointmentDays->sum(function ($day) use ($appointmentsByDay) {return $appointmentsByDay[$day]->total();}) }}
                                </h3>
                                <p class="mb-0">{{ __('Total Appointments') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border border-success bg-white shadow-lg h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-success p-3 mx-3"
                                style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">{{ $availableAppointments }}</h3>
                                <p class="mb-0">{{ __('Available Slots') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border border-info bg-white shadow-lg h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-info p-3 mx-3"
                                style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-clock text-white"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">{{ $bookedAppointments }}</h3>
                                <p class="mb-0">{{ __('Booked Appointments') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border border-warning bg-white shadow-lg h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="rounded-circle bg-warning p-3 mx-3"
                                style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-exclamation-circle text-white"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">{{ $pendingAppointments }}</h3>
                                <p class="mb-0">{{ __('Pending Review') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3">
                    @foreach ($appointmentDays as $day)
                        <li class="nav-item">
                            <a class="nav-link {{ $day == now()->format('l') ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#day-{{ $day }}">
                                {{ $day }}
                                <span class="badge bg-primary ms-1">
                                    {{ $appointmentsByDay[$day]->total() }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    @foreach ($appointmentDays as $day)
                        <div class="tab-pane fade {{ $day == now()->format('l') ? 'show active' : '' }}"
                            id="day-{{ $day }}">
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
                                        @forelse($appointmentsByDay[$day] as $appointment)
                                            <tr class="appointment-row {{ $appointment->status }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="me-2 {{ \Carbon\Carbon::parse($appointment->start_time)->isPast() ? 'text-danger' : 'text-success' }}">
                                                            <i class="fas fa-circle fs-xs"></i>
                                                        </span>
                                                        <div>
                                                            <strong>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</strong>
                                                            <br>
                                                            <small
                                                                class="text-muted">{{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        @if ($appointment->patient)
                                                            <strong>{{ $appointment->patient->name }}</strong>
                                                            <br>
                                                            <small
                                                                class="text-muted">{{ $appointment->patient->email }}</small>
                                                        @else
                                                            <span class="text-muted">{{ __('No patient assigned') }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
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
                                                        @if ($appointment->status != 'cancelled')
                                                            <a href="{{ route('prescription.create', ['appointment' => $appointment->id]) }}"
                                                                class="btn btn-light"
                                                                title="{{ __('Create Prescription') }}">
                                                                <i class="fas fa-prescription"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route('appointment.destroy', $appointment->id) }}"
                                                                method="POST" class="d-inline"
                                                                onsubmit="return confirm('{{ __('Are you sure you want to delete this appointment? This action cannot be undone.') }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    title="{{ __('Delete Appointment') }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-3">
                                                    {{ __('No appointments for this day') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if ($appointmentsByDay[$day]->hasPages())
                                <div class="p-3">
                                    {{ $appointmentsByDay[$day]->links() }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Remove this section as it's no longer needed -->
            {{-- @if ($appointments->hasPages())
                <div class="p-3">
                    {{ $appointments->links() }}
                </div>
            @endif --}}
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Keep track of active tab
            document.addEventListener('DOMContentLoaded', function() {
                // Get active tab from URL or localStorage
                const urlParams = new URLSearchParams(window.location.search);
                let activeDay = urlParams.get('day') || localStorage.getItem('activeDay') ||
                '{{ now()->format('l') }}';

                // Activate the tab
                const tab = document.querySelector(`a[href="#day-${activeDay}"]`);
                if (tab) {
                    const tabTrigger = new bootstrap.Tab(tab);
                    tabTrigger.show();
                }

                // Store active tab when changed
                document.querySelectorAll('.nav-tabs .nav-link').forEach(link => {
                    link.addEventListener('shown.bs.tab', function(e) {
                        const day = e.target.getAttribute('href').replace('#day-', '');
                        localStorage.setItem('activeDay', day);
                        // Update URL without page reload
                        const url = new URL(window.location);
                        url.searchParams.set('day', day);
                        window.history.pushState({}, '', url);
                    });
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .fs-xs {
                font-size: 8px;
            }

            .appointment-row.cancelled {
                background-color: #fff5f5;
            }

            .appointment-row.confirmed {
                background-color: #f0fff4;
            }
        </style>
    @endpush
@endsection
