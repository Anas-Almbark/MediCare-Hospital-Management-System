@extends('dashboard')
@section('content')
    <div class="mt-4 ml-3 col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Edit Fixed Salary</h4>
                <p class="mb-2">Modify the fixed salary for this employee.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('staticSalaries.update', $salary->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="number" name="salary" class="form-control" id="inputBaseSalary"
                            placeholder="Static Salary" step="1" value="{{ $salary->salary }}" required />
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Update Salary</button>
                            <a href="{{ route('staticSalaries.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
