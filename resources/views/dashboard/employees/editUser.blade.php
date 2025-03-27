@extends('dashboard')
@section('content')
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-auto mt-4">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">{{ __('Edit User') }}</h4>
                <p class="mb-2">{{ __('Update any user information you want to change') }}</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label for="profile_photo" class="form-label">{{ __('Profile Photo') }} ({{ __('Optional') }})</label>
                        <input type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror"
                            id="profile_photo" accept="image/*" />
                        @if($user->profile_photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Current Profile Photo" 
                                     class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        @endif
                        <small class="form-text text-muted">{{ __('Leave empty to keep current photo') }}</small>
                        @error('profile_photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
                                <option value="{{ $type }}"
                                    {{ old('blood_type', $user->blood_type) == $type ? 'selected' : '' }}>
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

                    <div class="form-group" id="specializationGroup" style="display: none;">
                        <label for="specialization" class="form-label">{{ __('Specialization') }}</label>
                        <select class="form-control @error('specialization') is-invalid @enderror" name="specialization" id="specialization">
                            <option selected disabled>{{ __('Select Specialization') }}</option>
                            @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->id }}" 
                                    {{ old('specialization', optional($user->doctor)->specialization_id) == $specialization->id ? 'selected' : '' }}>
                                    {{ $specialization->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('specialization')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" id="licenseGroup" style="display: none;">
                        <label for="license_number" class="form-label">{{ __('License Number') }}</label>
                        <input type="text" name="license_number" class="form-control @error('license_number') is-invalid @enderror"
                            id="license_number" placeholder="{{ __('License Number') }}" 
                            value="{{ old('license_number', optional($user->doctor)->license_number) }}" />
                        @error('license_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" id="experienceGroup" style="display: none;">
                        <label for="experience_years" class="form-label">{{ __('Years of Experience') }}</label>
                        <input type="number" name="experience_years" class="form-control @error('experience_years') is-invalid @enderror"
                            id="experience_years" placeholder="{{ __('Years of Experience') }}" 
                            value="{{ old('experience_years', optional($user->doctor)->experience_years) }}" min="0" />
                        @error('experience_years')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{--  is work (work , not work , banded)  --}}
                        <label for="status">{{ __('Status') }} ({{ __('Optional') }})</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status_account"
                            id="status">
                            <option value="">{{ __('Select Status') }}</option>
                            <option value="active"
                                {{ old('status', $user->status_account) == 'active' ? 'selected' : '' }}>
                                {{ __('Active') }}
                            </option>
                            <option value="not-active"
                                {{ old('status', $user->status_account) == 'not active' ? 'selected' : '' }}>
                                {{ __('Not active') }}
                            </option>
                            <option value="banded"
                                {{ old('status', $user->status_account) == 'banded' ? 'selected' : '' }}>
                                {{ __('Banded') }}
                            </option>
                        </select>
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

@push('scripts')
<script>
    $(document).ready(function() {
        const doctorFields = ['#specializationGroup', '#licenseGroup', '#experienceGroup'];
        
        function toggleDoctorFields(isDoctor) {
            doctorFields.forEach(field => {
                if (isDoctor) {
                    $(field).slideDown();
                    $(field + ' input, ' + field + ' select').prop('required', true);
                } else {
                    $(field).slideUp();
                    $(field + ' input, ' + field + ' select').prop('required', false);
                }
            });
        }

        $('#role').on('change', function() {
            toggleDoctorFields($(this).val() === 'doctor');
        });

        // Check initial state
        toggleDoctorFields($('#role').val() === 'doctor');
    });
</script>
@endpush
