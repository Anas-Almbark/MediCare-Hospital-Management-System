@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('Edit Lab Test Type') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('lab-type.update', $labType->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">{{ __('Test Type Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $labType->name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">{{ __('Test Price') }}</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    value="{{ $labType->price }}" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('lab-type.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Update Test Type') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
