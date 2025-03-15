@extends('dashboard')
@section('content')
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-auto mt-4">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Edit User</h4>
                <p class="mb-2">Update any user information you want to change</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="inputName">Name (Optional)</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="inputName" value="{{ old('name', $user->name) }}" placeholder="Enter name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birthDate">Birth Date (Optional)</label>
                        <input type="date" name="birth_date"
                            class="form-control @error('birth_date') is-invalid @enderror" id="birthDate"
                            value="{{ old('birth_date', $user->birth_date) }}">
                        @error('birth_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bloodType">Blood Type (Optional)</label>
                        <select class="form-control @error('blood_type') is-invalid @enderror" name="blood_type"
                            id="bloodType">
                            <option value="">Select Blood Type</option>
                            <option value="A+" {{ old('blood_type', $user->blood_type) == 'A+' ? 'selected' : '' }}>A+
                            </option>
                            <option value="A-" {{ old('blood_type', $user->blood_type) == 'A-' ? 'selected' : '' }}>A-
                            </option>
                            <option value="B+" {{ old('blood_type', $user->blood_type) == 'B+' ? 'selected' : '' }}>B+
                            </option>
                            <option value="B-" {{ old('blood_type', $user->blood_type) == 'B-' ? 'selected' : '' }}>B-
                            </option>
                            <option value="O+" {{ old('blood_type', $user->blood_type) == 'O+' ? 'selected' : '' }}>O+
                            </option>
                            <option value="O-" {{ old('blood_type', $user->blood_type) == 'O-' ? 'selected' : '' }}>O-
                            </option>
                            <option value="AB+" {{ old('blood_type', $user->blood_type) == 'AB+' ? 'selected' : '' }}>
                                AB+</option>
                            <option value="AB-" {{ old('blood_type', $user->blood_type) == 'AB-' ? 'selected' : '' }}>
                                AB-</option>
                        </select>
                        @error('blood_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address (Optional)</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address"
                            placeholder="Enter address" rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number (Optional)</label>
                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" value="{{ old('phone', $user->phone_number) }}"
                            placeholder="Enter phone number">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role (Optional)</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                @if ($user->roles->contains($role))
                                    <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
