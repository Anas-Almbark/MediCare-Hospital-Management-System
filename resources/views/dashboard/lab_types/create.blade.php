@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('Create Lab Test Type') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('lab-type.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="form-label fw-bold">{{ __('Test Name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Enter test name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="price" class="form-label fw-bold">{{ __('Test Price') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="0.00" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('lab-type.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-success">{{ __('Create Test Type') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
