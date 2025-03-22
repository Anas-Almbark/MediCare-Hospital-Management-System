@extends('dashboard')
@section('content')
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-auto mt-4">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">{{ __('Edit User') }}</h4>
                <p class="mb-2">{{ __('Update any user information you want to change') }}</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="inputName">{{ __('Name') }} ({{ __('Optional') }})</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="inputName" value="{{ old('name', $user->name) }}" placeholder="{{ __('Enter name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birthDate">{{ __('Birth Date') }} ({{ __('Optional') }})</label>
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
                        <label for="bloodType">{{ __('Blood Type') }} ({{ __('Optional') }})</label>
                        <select class="form-control @error('blood_type') is-invalid @enderror" name="blood_type"
                            id="bloodType">
                            <option value="">{{ __('Select Blood Type') }}</option>
                            @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                                <option value="{{ $type }}" {{ old('blood_type', $user->blood_type) == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('blood_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('Address') }} ({{ __('Optional') }})</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address"
                            placeholder="{{ __('Enter address') }}" rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('Phone Number') }} ({{ __('Optional') }})</label>
                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" value="{{ old('phone', $user->phone_number) }}"
                            placeholder="{{ __('Enter phone number') }}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">{{ __('Role') }} ({{ __('Optional') }})</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option value="">{{ __('Select Role') }}</option>
                            @foreach ($roles as $role)
                                @if ($user->roles->contains($role))
                                    <option value="{{ $role->name }}" selected>{{ __($role->name) }}</option>
                                @else
                                    <option value="{{ $role->name }}">{{ __($role->name) }}</option>
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
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
