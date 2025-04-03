<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('available.appointments') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-calendar-plus me-1"></i> Find Available Doctors
    </a>
</div>

<div class="row">
    @php
        $myDoctors = App\Models\Doctor::whereHas('appointments', function($query) {
            $query->where('patient_id', auth()->id());
        })
        ->with(['user', 'specialization'])
        ->get();

        // For debugging - uncomment to check the data
        // dd($myDoctors->toArray());
    @endphp
    
    @forelse($myDoctors as $doctor)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="doctor-profile mb-3">
                        @if($doctor->user && $doctor->user->profile_photo)
                            <img src="{{ asset('storage/' . $doctor->user->profile_photo) }}" 
                                 alt="Dr. {{ $doctor->user->name }}" 
                                 class="rounded-circle" 
                                 style="width: 100px; height: 100px; object-fit: cover;"/>
                        @else
                            <img src="{{ asset('assets/img/default-avatar.png') }}" 
                                 alt="Doctor" 
                                 class="rounded-circle" 
                                 style="width: 100px; height: 100px; object-fit: cover;"/>
                        @endif
                    </div>
                    <h5 class="card-title fw-bold">Dr. {{ optional($doctor->user)->name }}</h5>
                    <p class="card-text text-primary">
                        <i class="fas fa-stethoscope me-1"></i>
                        {{ optional($doctor->specialization)->name ?? 'General Practice' }}
                    </p>
                    <div class="doctor-contact mt-3">
                        <p><i class="fas fa-envelope me-2"></i>{{ $doctor->user->email ?? 'N/A' }}</p>
                        <p><i class="fas fa-phone me-2"></i>{{ $doctor->user->phone_number ?? 'Not available' }}</p>
                        <p><i class="fas fa-calendar-check me-2"></i>Last Visit: 
                            @php
                                $lastVisit = App\Models\Appointment::where('doctor_id', $doctor->id)
                                    ->where('patient_id', auth()->id())
                                    ->where('status', 'completed')
                                    ->latest('date')
                                    ->first();
                            @endphp
                            {{ $lastVisit ? \Carbon\Carbon::parse($lastVisit->date)->format('M d, Y') : 'No completed visits' }}
                        </p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('doctors-detail', $doctor->id) }}" class="btn btn-primary">
                            <i class="fas fa-user-md me-1"></i>View Profile
                        </a>
                        <a href="{{ route('available.appointments', ['doctor_id' => $doctor->id]) }}" class="btn btn-success">
                            <i class="fas fa-calendar-plus me-1"></i>Book New Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-user-md fa-3x mb-3"></i>
                <p>You haven't visited any doctors yet.</p>
                <a href="{{ route('available.appointments') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-search me-1"></i>Find a Doctor
                </a>
            </div>
        </div>
    @endforelse
</div>