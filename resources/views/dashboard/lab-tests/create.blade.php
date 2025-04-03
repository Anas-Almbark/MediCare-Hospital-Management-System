@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <div class="p-4">
        <div class="card pt-3">
            <div class="card-header">
                <h3>Create New Lab Test</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('lab-test.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="" @readonly(true)>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone_number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="national_id">National ID</label>
                                <input type="text" class="form-control" id="national_id" name="identity_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lab_type_id">Required Test</label>
                                <select class="form-control" id="lab_type_id" name="lab_type_id" required>
                                    <option value="" @readonly(true)>Select Test</option>
                                    @foreach ($labTypes ?? [] as $labType)
                                        <option value="{{ $labType->id }}">{{ $labType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
