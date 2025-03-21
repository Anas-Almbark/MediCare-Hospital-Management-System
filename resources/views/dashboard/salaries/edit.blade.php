@extends('dashboard')
@section('content')
    <div class="mx-auto mt-4 col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">edit record salary </h4>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('salaries.update', $salary->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <div class="form-group">
                            <label for="base_salary">Base Salary</label>
                            <input type="number" step="1" value="{{ $salary->base_salary }}"
                                class="form-control @error('base_salary') is-invalid @enderror" id="base_salary"
                                name="base_salary" required>
                            @error('base_salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bonus">Bonus</label>
                            <input type="number" step="0.01" value="{{ $salary->bonus }}"
                                class="form-control @error('bonus') is-invalid @enderror" id="bonus" name="bonus">
                            @error('bonus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deductions">Deductions</label>
                            <input type="number" step="0.01" value="{{ $salary->deductions }}"
                                class="form-control @error('deductions') is-invalid @enderror" id="deductions"
                                name="deductions">
                            @error('deductions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="payment_date">Payment Date</label>
                            <input type="date" class="form-control @error('payment_date') is-invalid @enderror"
                                id="payment_date" value="{{ $salary->payment_date }}" name="payment_date" required>
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
