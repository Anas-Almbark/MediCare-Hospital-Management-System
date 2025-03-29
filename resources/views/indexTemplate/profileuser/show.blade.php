@extends('indexTemplate.profileUser.profile-layout')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
           
        </a>
        <div class="d-flex">
            <a href="{{ route('welcome') }}" class="btn btn-outline-light me-2">Home</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar py-4">
            <div class="position-sticky">
                <div class="text-center mb-4">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                             alt="Profile" 
                             class="rounded-circle mb-3"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <i class="fas fa-user-circle" style="font-size: 100px; color: #3fbbc0;"></i>
                    @endif
                    <h5 class="mt-2">{{ auth()->user()->name }}</h5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-user-circle me-2"></i>Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-calendar-check me-2"></i>Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-medical me-2"></i>Medical Records
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
            <div class="row">
                <!-- Profile Information Card -->
                <div class="col-md-6 mb-4">
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
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">My Doctors</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse([1,2] as $doctor) 
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-user-md fa-3x mb-3 text-info"></i>
                                            <h6>Dr. John Doe</h6>
                                            <p class="text-muted small">Cardiologist</p>
                                            <a href="#" class="btn btn-sm btn-outline-info">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center">
                                    <p>No doctors assigned yet.</p>
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
.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1030;
}

.container-fluid {
    margin-top: 56px; 
}

.sidebar {
    min-height: calc(100vh - 56px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    padding-top: 20px;
}

.sidebar .nav-link {
    color: #333;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    margin-bottom: 0.5rem;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background-color: #e9ecef;
    color: #0d6efd;
}

.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
@endsection
