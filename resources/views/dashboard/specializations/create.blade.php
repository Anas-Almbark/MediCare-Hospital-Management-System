@extends('dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add New Specialization') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('specialization.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                <a href="{{ route('specialization.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection