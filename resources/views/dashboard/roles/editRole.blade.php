@extends('dashboard')
@section('content')
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header"> update Role </h5>
            <div class="card-body">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="defaultFormControlInput"
                            value="{{ $role->name }}" aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div class="my-2">
                        <label for="permissions" class="form-label">Select Permissions</label>
                        <select class="form-select w-100" name="permissions[]" id="permissions" multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}"
                                    {{ in_array($permission->name, $selectedPermissions) ? 'selected' : '' }}>
                                    {{ $permission->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success mt-3"> Update </button>
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
                $('#permissions').select2({
                    placeholder: 'Select permissions',
                    allowClear: true,
                    width: '100%'
                });
            } else {
                console.error('Select2 is not loaded');
            }
        });
    </script>
@endpush
