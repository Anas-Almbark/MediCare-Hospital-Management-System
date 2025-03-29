@extends('indexTemplate.profileUser.profile-layout')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
  
                    <!-- Profile Information Card -->
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Profile Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        {{ auth()->user()->name }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        {{ auth()->user()->email }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        {{ auth()->user()->phone_number ?? 'Not set' }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        {{ auth()->user()->address ?? 'Not set' }}
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                        <i class="fas fa-edit me-1"></i>Edit Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doctors Card -->
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0">My Doctors</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        $myDoctors = App\Models\Appointment::where('patient_id', auth()->id())
                                        ->with('doctor.specialization')
                                        ->distinct('doctor_id')
                                        ->get()
                                        ->pluck('doctor');
                                    @endphp
                                    
                                    @forelse($myDoctors as $doctor)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                @if($doctor->profile_photo)
                                                    <img src="{{ asset('storage/' . $doctor->profile_photo) }}" 
                                                         alt="Dr. {{ $doctor->name }}" 
                                                         class="rounded-circle mb-3" 
                                                         style="width: 80px; height: 80px; object-fit: cover;">
                                                @else
                                                    <i class="fas fa-user-md fa-3x mb-3 text-info"></i>
                                                @endif
                                                <h6>Dr. {{ $doctor->name }}</h6>
                                                <p class="text-muted small">{{ $doctor->specialization->name ?? 'General' }}</p>
                                                <a href="{{ route('doctors-detail', ['id' => $doctor->id]) }}" class="btn btn-sm btn-outline-info">
                                                    View Profile
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-12 text-center">
                                        <p>No appointments with any doctors yet.</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prescriptions Card -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">Medical Prescriptions</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Doctor</th>
                                                <th>Diagnosis</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2024-01-20</td>
                                                <td>Dr. John Doe</td>
                                                <td>Regular Checkup</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profileuser.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="profile_photo" class="form-label">Profile Photo</label>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ auth()->user()->phone_number }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3">{{ auth()->user()->address }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.content-wrapper {
    margin-left: 250px; /* عرض السايد بار */
    transition: margin-left 0.3s;
}

.container-fluid {
    padding: 20px;
    margin-top: 0;
}

@media (max-width: 768px) {
    .content-wrapper {
        margin-left: 0;
    }
}

.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    height: 100%;
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.row.g-4 {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 1.5rem;
}

/* تحسين تنسيق الجداول في الشاشات الصغيرة */
.table-responsive {
    margin: 0;
    padding: 0;
    border-radius: 0.5rem;
}

/* تحسين المسافات بين العناصر */
.card-body {
    padding: 1.5rem;
}

.card-header {
    padding: 1rem 1.5rem;
}

/* تخصيص خلفية Modal */
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.7) !important;
    opacity: 1 !important;
    z-index: 1040 !important;
}

.modal {
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-dialog {
    z-index: 1050;
}

.modal-content {
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1050;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('editProfileModal');
    modal.addEventListener('show.bs.modal', function () {
        document.body.classList.add('modal-open');
    });
});
</script>
@endsection
