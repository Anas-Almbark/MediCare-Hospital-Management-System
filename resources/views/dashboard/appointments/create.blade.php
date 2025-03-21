@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">New appointment</h4>
                <p class="mb-2">Create a new appointment.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('appointment.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="doctor" class="form-control" id="inputDoctor" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="patient" class="form-control" id="inputPatient" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="input-group col-md-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                    </div>
                                </div><input name="date" class="form-control" id="datetimepicker" type="text" value="{{ now() }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="status" class="form-control" id="inputPatient" required>
                            <option value="pending">pending</option>
                            <option value="confirmed">confirmed</option>
                            <option value="cancelled">cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="notes" class="form-control" id="inputDetails" 
                            placeholder="Appointment Details" rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Create appointment</button>
                            <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Internal jquery.maskedinput js -->
    <script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>

    <!-- Internal Spectrum-colorpicker js -->
    <script src="{{ asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>

    <!-- Internal Ion.rangeSlider js -->
    <script src="{{ asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Internal jquery-simple-datetimepicker js -->
    <script src="{{ asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>

    <!-- Ionicons js -->
    <script src="{{ asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                minDate: new Date(),
                icons: {
                    time: 'fas fa-clock',
                    date: 'fas fa-calendar',
                    up: 'fas fa-chevron-up',
                    down: 'fas fa-chevron-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-screenshot',
                    clear: 'fas fa-trash',
                    close: 'fas fa-remove'
                }
            });
        });
    </script>
    @endpush

    @endsection