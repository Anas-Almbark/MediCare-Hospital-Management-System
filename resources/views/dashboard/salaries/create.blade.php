@extends('dashboard')
@section('content')
    <div class="mx-auto mt-4 col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Add New Salary</h4>
                <p class="mb-2">Add a new salary record for an employee</p>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('salaries.store') }}">
                    @csrf
                    <div class="">
                        <div class="form-group">
                            <label for="emp_id">Employee</label>
                            <select class="form-control @error('employee') is-invalid @enderror" name="employee"
                                id="emp_id">
                                <option selected disabled>Select Employee</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('employee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="base_salary">Base Salary</label>
                            <input type="number" step="1"
                                class="form-control @error('base_salary') is-invalid @enderror" id="base_salary"
                                name="base_salary" required>
                            @error('base_salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bonus">Bonus</label>
                            <input type="number" step="0.01" class="form-control @error('bonus') is-invalid @enderror"
                                id="bonus" name="bonus">
                            @error('bonus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deductions">Deductions</label>
                            <input type="number" step="0.01"
                                class="form-control @error('deductions') is-invalid @enderror" id="deductions"
                                name="deductions">
                            @error('deductions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="payment_date">Payment Date</label>
                            <input type="date" value="{{ date('Y-m-d') }}"
                                class="form-control @error('payment_date') is-invalid @enderror" id="payment_date"
                                name="payment_date" required>
                            @error('payment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        window.addEventListener('load', function() {
            if ($.fn.select2) {
                $('#emp_id').select2({
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
