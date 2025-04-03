@extends('indexTemplate.profileUser.profile-layout')

@section('content')
<div class="container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
 
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="container-fluid">


        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-4">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="pl-0">
                            <div class="main-profile-overview">
                                <div class="main-img-user profile-user">
                                    @if(auth()->user()->profile_photo)
                                    <img alt="{{ auth()->user()->name }}" src="{{ asset('storage/' . auth()->user()->profile_photo) }}">
                                @else
                                    <img alt="Default Avatar" src="{{ asset('assets/img/faces/default.jpg') }}">
                                @endif
                                <a class="fas fa-camera profile-edit" href="JavaScript:void(0);" data-bs-toggle="modal" data-bs-target="#editProfileModal"></a>
                                 </div>
                                <div class="d-flex justify-content-between mg-b-20">
                                    <div>
                                        <h5 class="main-profile-name">{{ auth()->user()->name }}</h5>
                                        <p class="main-profile-name-text">Patient</p>
                                    </div>
                                </div>
                                
                                <!-- main-profile-bio -->
                                <div class="row">
                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $appointments_count ?? 0 }}</h5>
                                        <h6 class="text-small text-muted mb-0">Appointments</h6>
                                    </div>
                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $prescriptions_count ?? 0 }}</h5>
                                        <h6 class="text-small text-muted mb-0">Prescriptions</h6>
                                    </div>
                                    <div class="col-md-4 col mb20">
                                        <h5>{{ $doctors_count ?? 0 }}</h5>
                                        <h6 class="text-small text-muted mb-0">Doctors</h6>
                                    </div>
                                </div>
                                <hr class="mg-y-30">
                                <h6>Contact Information</h6>
                                <div class="main-profile-bio">
                                    <p><i class="fas fa-envelope mr-2"></i> {{ auth()->user()->email }}</p>
                                    <p><i class="fas fa-phone mr-2"></i> {{ auth()->user()->phone_number ?? 'Not set' }}</p>
                                    <p><i class="fas fa-map-marker-alt mr-2"></i> {{ auth()->user()->address ?? 'Not set' }}</p>
                                </div>
                                <hr class="mg-y-30">
                                <h6>Skills</h6>
                                <div class="skill-bar mb-4 clearfix mt-3">
                                    <span>HTML5 / CSS3</span>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-primary-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%"></div>
                                    </div>
                                </div>
                                <!--skill bar-->
                                <div class="skill-bar mb-4 clearfix">
                                    <span>Javascript</span>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-danger-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 89%"></div>
                                    </div>
                                </div>
                                <!--skill bar-->
                                <div class="skill-bar mb-4 clearfix">
                                    <span>Bootstrap</span>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-success-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!--skill bar-->
                                <div class="skill-bar clearfix">
                                    <span>Coffee</span>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-info-gradient" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                    </div>
                                </div>
                                <!--skill bar-->
                            </div><!-- main-profile-overview -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row row-sm">
                    <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    <div class="counter-icon bg-primary-transparent">
                                        <i class="icon-layers text-primary"></i>
                                    </div>
                                    <div class="ml-auto">
                                        <h5 class="tx-13">Orders</h5>
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">1,587</h2>
                                        <p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    <div class="counter-icon bg-danger-transparent">
                                        <i class="icon-paypal text-danger"></i>
                                    </div>
                                    <div class="ml-auto">
                                        <h5 class="tx-13">Revenue</h5>
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">46,782</h2>
                                        <p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="counter-status d-flex md-mb-0">
                                    <div class="counter-icon bg-success-transparent">
                                        <i class="icon-rocket text-success"></i>
                                    </div>
                                    <div class="ml-auto">
                                        <h5 class="tx-13">Product sold</h5>
                                        <h2 class="mb-0 tx-22 mb-1 mt-1">1,890</h2>
                                        <p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tabs-menu ">
                            <!-- Tabs -->
                            <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                                <li class="active">
                                    <a href="#appointments" data-toggle="tab" aria-expanded="true" id="appointments-tab" > <span class="visible-xs"> <i class="fas fa-calendar-check me-2"></i></span> <span class="hidden-xs">Appointments</span> </a>
                                </li>
                                <li class="">
                                    <a href="#prescriptions" data-toggle="tab" aria-expanded="false" id="prescriptions-tab"> <span class="visible-xs"> <i class="fas fa-prescription me-2"></i></span> <span class="hidden-xs">Prescriptions</span> </a>
                                </li>
                                <li class="">
                                    <a href="#doctors" data-toggle="tab" aria-expanded="false" id="doctors-tab"> <span class="visible-xs" > <i class="fas fa-user-md me-2"></i></span> <span class="hidden-xs">Doctors</span> </a>
                                </li>
                                <li class="">
                                    <a href="#records" data-toggle="tab" aria-expanded="false" id="records-tab" > <span class="visible-xs"> <i class="fas fa-file-medical me-2"></i></span> <span class="hidden-xs">Records</span> </a>
                                </li>
                               
                            </ul>
                        </div>
                        <div class="tab-content border p-3 mt-3">
                            <div class="tab-pane active" id="appointments">
                                @include('indexTemplate.profileuser.partials.appointments')
                            </div>
                            <div class="tab-pane" id="prescriptions">
                                @include('indexTemplate.profileuser.partials.prescriptions')
                            </div>
                            <div class="tab-pane" id="medical-records">
                                @include('indexTemplate.profileuser.partials.medical-records')
                            </div>
                            <div class="tab-pane" id="doctors">
                                @include('indexTemplate.profileuser.partials.doctors')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

   
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
</div>

<!-- Edit Profile Modal -->
@include('indexTemplate.profileuser.partials.edit-profile-modal')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Bootstrap tabs
    var triggerTabList = [].slice.call(document.querySelectorAll('#profileTabs a'))
    triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)
        triggerEl.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
        })
    })
});
</script>
<script>
    $(document).ready(function() {
        $('[data-bs-toggle="tab"]').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
    </script>
@endpush
