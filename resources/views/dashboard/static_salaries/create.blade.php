@extends('dashboard')
@section('content')
    <div class="mt-4 ml-3 col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">New Fixed Salary</h4>
                <p class="mb-2">Add a new fixed salary for an employee.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('staticSalaries.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="employee" class="form-control" id="Employee" required>
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" name="salary" class="form-control" id="inputBaseSalary"
                            placeholder="static Salary" step="1" required />
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Add static Salary</button>
                            <a href="{{ route('staticSalaries.index') }}" class="btn btn-secondary">Cancel</a>
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
                $('#Employee').select2({
                    placeholder: 'Select Employee',
                    allowClear: true,
                    width: '100%'
                });
            } else {
                console.error('Select2 is not loaded');
            }
        });
    </script>
@endpush
