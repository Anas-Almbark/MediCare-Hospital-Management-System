@extends('dashboard')
@section('content')
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">New Doctor</h4>
                <p class="mb-2">Create a new doctor account with appropriate role.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('doctor.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Doctor Name"
                            required />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email"
                            required />
                    </div>
                    <div class="form-group">
                        <input type="text" name="specialty" class="form-control" id="inputSpecialty" 
                            placeholder="Specialty" required />
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" id="inputPhone" 
                            placeholder="Phone Number" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="inputPassword3"
                            placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="role" id="role">
                            <option selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Create Doctor</button>
                            <a href="{{ route('doctor.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
