@extends('dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ __('Specializations') }}</h3>
                            <a href="{{ route('specialization.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('Add New') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Doctors Count') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($specializations as $specialization)
                                        <tr>
                                            <td>{{ $specialization->name }}</td>
                                            <td>{{ $specialization->doctors()->count() }}</td>
                                            <td>
                                                <div class="btn-group" style="gap: 5px;">
                                                    <a href="{{ route('specialization.edit', $specialization) }}" 
                                                       class="btn btn-warning btn-sm me-2">
                                                        <i class="fas fa-edit">Edit</i>
                                                    </a>
                                                    <form action="{{ route('specialization.destroy', $specialization) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash">Delete</i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">{{ __('No specializations found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $specializations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection