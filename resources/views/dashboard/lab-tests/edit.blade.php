@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <div class="p-4">
        <div class="card pt-3">
            <div class="card-header">
                <h3>Edit Lab Test</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('lab-test.update', $labTest->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $labTest->patientData->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="" @readonly(true)>Select Gender</option>
                                    <option value="male" {{ $labTest->patientData->gender == 'male' ? 'selected' : '' }}>
                                        Male</option>
                                    <option value="female"
                                        {{ $labTest->patientData->gender == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ $labTest->patientData->phone_number }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="national_id">National ID</label>
                                <input type="text" class="form-control" id="national_id" name="identity_number"
                                    value="{{ $labTest->patientData->identity_number }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctor_id">Doctor Name</label>
                                <select class="form-control" id="doctor_id" name="doctor">
                                    <option value="">Select Doctor</option>
                                    @foreach ($doctors ?? [] as $doctor)
                                        <option value="{{ $doctor->id }}"
                                            {{ $labTest->doctorData?->id == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lab_type_id">Required Test</label>
                                <select class="form-control" id="lab_type_id" name="lab_type_id" required>
                                    <option value="" @readonly(true)>Select Test</option>
                                    @foreach ($labTypes ?? [] as $labType)
                                        <option value="{{ $labType->id }}"
                                            {{ $labTest->lab_type_id == $labType->id ? 'selected' : '' }}>
                                            {{ $labType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="" @readonly(true)>Select Status</option>
                                    <option value="pending" {{ $labTest->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="completed" {{ $labTest->status == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="cancelled" {{ $labTest->status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="block w-100 col-md-6">
                        <div class="row mb-4">
                            <div class="col-sm-12 col-md-4">
                                <input type="file" name="result" class="dropify" data-height="200"
                                    data-default-file="{{ $labTest->result ?? '' }}" />
                                @error('result')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
