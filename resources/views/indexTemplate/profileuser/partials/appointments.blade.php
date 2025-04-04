<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $appointments = App\Models\Appointment::where('patient_id', auth()->id())
                    ->with(['doctor' => function($query) {
                        $query->join('users', 'doctors.doctor', '=', 'users.id')
                              ->join('specializations', 'doctors.specialization_id', '=', 'specializations.id')
                              ->select('doctors.*', 'users.name', 'users.profile_photo', 'specializations.name as specialization_name');
                    }])
                    ->orderBy('date', 'desc')
                    ->get();
            @endphp

            @forelse($appointments as $appointment)
                <tr>
                    <td>
                        @if($appointment->doctor)
                            <div class="d-flex align-items-center">
                                <img src="{{ $appointment->doctor->profile_photo 
                                    ? asset('storage/' . $appointment->doctor->profile_photo) 
                                    : asset('assets/img/default-avatar.png') }}" 
                                    class="rounded-circle me-2" 
                                    style="width: 40px; height: 40px; object-fit: cover;"
                                    alt="Dr. {{ $appointment->doctor->name }}">
                                <div>
                                    <div class="fw-bold">Dr. {{ $appointment->doctor->name }}</div>
                                    <small class="text-muted">
                                        {{ $appointment->doctor->specialization_name }}
                                    </small>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">
                                <i class="fas fa-user-md me-1"></i>Doctor not found
                            </span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y h:i A') }}</td>
                    <td>
                        @php
                            $statusColors = [
                                'pending' => ['bg' => 'warning', 'icon' => 'clock'],
                                'completed' => ['bg' => 'success', 'icon' => 'check-circle'],
                                'cancelled' => ['bg' => 'danger', 'icon' => 'times-circle'],
                                'confirmed' => ['bg' => 'info', 'icon' => 'calendar-check']
                            ];
                            $status = $statusColors[$appointment->status] ?? ['bg' => 'secondary', 'icon' => 'question-circle'];
                        @endphp
                        <span class="badge bg-{{ $status['bg'] }} text-white d-inline-flex align-items-center">
                            <i class="fas fa-{{ $status['icon'] }} me-1"></i>
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td>
                        @if($appointment->status === 'pending')
                            <button class="btn btn-sm btn-outline-danger" onclick="cancelAppointment({{ $appointment->id }})">
                                <i class="fas fa-times-circle me-1"></i>Cancel
                            </button>
                        @endif
                        <a href="{{ route('appointment.show', $appointment->id) }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-info-circle me-1"></i>Details
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        <i class="fas fa-calendar-times fa-2x mb-2"></i>
                        <p>No appointments found</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>