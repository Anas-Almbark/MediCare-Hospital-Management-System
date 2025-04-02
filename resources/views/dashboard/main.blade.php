@extends('dashboard')
@section('content')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('Hi, welcome back!') }}</h2>
                    <p class="mg-b-0">{{ __('Hospital Management System Dashboard') }}</p>
                </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">{{ __('Total Doctors') }}</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ 55 }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">{{ __('Total Registered Doctors') }}</p>
                                </div>
                                <span class="float-right my-auto ml-auto">
                                    <i class="fas fa-user-md text-white mx-2"></i>
                                    <span class="text-white op-7"> {{ __('Active') }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">{{ __('Total Patients') }}</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ 234 }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">{{ __('Total Registered Patients') }}</p>
                                </div>
                                <span class="float-right my-auto ml-auto">
                                    <i class="fas fa-procedures text-white mx-2"></i>
                                    <span class="text-white op-7"> {{ __('Active') }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">{{ __('Total Secretaries') }}</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ 25 }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">{{ __('Total Registered Secretaries') }}</p>
                                </div>
                                <span class="float-right my-auto ml-auto">
                                    <i class="fas fa-user-tie text-white mx-2"></i>
                                    <span class="text-white op-7"> {{ __('Active') }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-warning-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">{{ __('Available Rooms') }}</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ 45 }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">{{ __('Total Available Patient Rooms') }}</p>
                                </div>
                                <span class="float-right my-auto ml-auto">
                                    <i class="fas fa-bed text-white mx-2"></i>
                                    <span class="text-white op-7"> {{ __('Active') }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-sm-12 col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Patient Growth
                        </div>
                        <p class="mg-b-20">Chart showing new patient registrations over time.</p>
                        <div class="chartjs-wrapper-demo">
                            <canvas id="chartLine1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card mg-b-md-20 overflow-hidden">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Lab Tests Distribution
                        </div>
                        <p class="mg-b-20">Distribution of laboratory tests by status.</p>
                        <div class="chartjs-wrapper-demo">
                            <span class="display" id="lab-tests"
                                data-tests="{{ $labTests->pluck('labType')->pluck('name')->unique() }}"
                                data-values={{ $labTests->pluck('labType')->pluck('name')->countBy()->values()->join(',') }}>
                            </span>
                            <canvas id="labTestsPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-sm-12 col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Bed Occupancy
                        </div>
                        <p class="mg-b-20">Hospital bed occupancy status.</p>
                        <div class="chartjs-wrapper-demo">
                            <canvas id="bedOccupancyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Lab Test Requests Status
                        </div>
                        <p class="mg-b-20">Distribution of laboratory test requests by their current status.</p>
                        <div class="chartjs-wrapper-demo">
                            <canvas id="labTestRequestsStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">Gender Distribution</div>
                    <p class="mg-b-20">Distribution of male and female patients</p>
                    <div class="chartjs-wrapper-demo">
                        <canvas id="genderDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Doctors Performance</h3>
            </div>
            <div class="card-body">
                <canvas id="doctorsPerformanceChart" height="70"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Revenue Sources') }}</h3>
            </div>
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    {{ __('Hospital Revenue Distribution') }}
                </div>
                <p class="mg-b-20">{{ __('Distribution of revenue across different hospital services') }}</p>
                <div class="chartjs-wrapper-demo">
                    <canvas id="revenueSourcesChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/line-charts.js') }}"></script>
    <script src="{{ asset('assets/js/pie-charts.js') }}"></script>
    <script src="{{ asset('assets/js/vesical-charts.js') }}"></script>
    <script src="{{ asset('assets/js/bar-charts.js') }}"></script>
    <script src="{{ asset('assets/js/Lab_status_harts.js') }}"></script>
    <script src="{{ asset('assets/js/column_charts.js') }}"></script>
    <script src="{{ asset('assets/js/gender_charts.js') }}"></script>
@endpush
