@extends('indexTemplate.profileUser.profile-layout')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-primary">Doctor Schedules</h2>
                </div>

                @if($doctors->isEmpty())
                    <div class="alert alert-info text-center p-4">
                        <i class="fas fa-user-md fa-3x mb-3"></i>
                        <h4>No Doctors Available</h4>
                        <p>Currently there are no doctors with schedules.</p>
                    </div>
                @else
                    @foreach($doctors as $doctor)
                        @if($doctor->schedules->flatMap->appointments->isNotEmpty())
                            <div class="accordion mb-3" id="doctorAccordion{{ $doctor->id }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $doctor->id }}">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    @if($doctor->profile_photo)
                                                    <img src="{{ asset('storage/' . $doctor->profile_photo) }}" alt="{{ $doctor->name }}" class="rounded-circle" style="width: 100px; height: 100px;"/>
                                                @else
                                                    <img src="{{ asset('assets/img/default-avatar.png') }}" alt="{{ $doctor->name }}" class="rounded-circle" style="width: 100px; height: 100px;"/>
                                                @endif
                                                </div>
                                                  
                                                <div>
                                                    <h6 class="mb-0">Dr. {{ $doctor->name }}</h6>
                                                    <small>{{ optional($doctor->doctor)->specialization->name ?? 'General' }}</small>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $doctor->id }}" class="accordion-collapse collapse" data-bs-parent="#doctorAccordion{{ $doctor->id }}">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Day</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($doctor->schedules as $schedule)
                                                            @foreach($schedule->appointments->where('status', 'available') as $appointment)
                                                                <tr>
                                                                    <td>{{ \Carbon\Carbon::parse($appointment->date)->format('l') }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</td>
                                                                    <td>
                                                                        <span class="badge bg-success">Available</span>
                                                                    </td>
                                                                    <td>
                                                                        <form action="{{ route('appointment.book', ['appointment' => $appointment->id]) }}" 
                                                                              method="POST" 
                                                                              class="d-inline booking-form">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-primary btn-sm book-btn">
                                                                                <i class="fas fa-calendar-check me-1"></i> Book Now
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<form action="{{ route('appointment.book', ['appointment' => $appointment->id]) }}" 
      method="POST" 
      class="d-inline booking-form">
    @csrf
    <button type="submit" class="btn btn-primary btn-sm book-btn">
        <i class="fas fa-calendar-check me-1"></i> Book Now
    </button>
</form>
@endsection