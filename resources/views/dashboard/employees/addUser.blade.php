@extends('dashboard')
@section('content')
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-auto mt-5">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">{{ __('New User') }}</h4>
                <p class="mb-2">{{ __('Create a new user account with appropriate role.') }}</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Full Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="{{ __('Password') }}" required />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role" class="form-label">{{ __('User Role') }}</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option selected disabled>{{ __('Select Role') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                    {{ __($role->name) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dp1742037476809" class="form-label">{{ __('Date of Birth') }}</label>
                        <div class="input-group w-100">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input
                                class="form-control fc-datepicker hasDatepicker @error('birth_date') is-invalid @enderror"
                                name="birth_date" placeholder="{{ __('MM/DD/YYYY') }}" type="date" id="dp1742037476809"
                                value="{{ old('birth_date') }}">
                        </div>
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ __('Gender') }}</label>
                        <div class="d-flex">
                            <div class="form-check mr-3">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                    name="gender" id="male" value="male"
                                    {{ old('gender') == 'male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">{{ __('Male') }}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                    name="gender" id="female" value="female"
                                    {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">{{ __('Female') }}</label>
                            </div>
                        </div>
                        @error('gender')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="blood_type" class="form-label">{{ __('Blood Type') }}</label>
                        <select class="form-control @error('blood_type') is-invalid @enderror" name="blood_type"
                            id="blood_type">
                            <option selected disabled>{{ __('Select Blood Type') }}</option>
                            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}</option>
                            @endforeach
                        </select>
                        @error('blood_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                            id="address" placeholder="{{ __('Address') }}" value="{{ old('address') }}" required />
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phoneMask" class="form-label">{{ __('Phone Number') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    {{ __('Phone:') }}
                                </div>
                            </div>
                            <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                id="phone" placeholder="{{ __('(000) 000-0000') }}" type="text" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="identity_no" class="form-label">{{ __('National ID Number') }}</label>
                        <input type="text" name="identity_number"
                            class="form-control @error('identity_number') is-invalid @enderror" id="identity_no"
                            placeholder="{{ __('Identity Document') }}" value="{{ old('identity_number') }}" required />
                        @error('identity_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">{{ __('Create User') }}</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        window.addEventListener('load', function() {
            if ($.fn.select2) {
                $('#role').select2({
                    placeholder: 'Select role',
                    allowClear: true,
                    width: '100%'
                });
            } else {
                console.error('Select2 is not loaded');
            }
        });
    </script>
@endpush
