@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
    <div class="container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">Prescriptions</h4>
                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Prescription Details</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('prescription.edit', $prescription->id) }}" class="btn btn-info">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
                <div class="pr-1 mb-3 mb-xl-0">
                    <form action="{{ route('prescription.destroy', $prescription->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this prescription?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mb-4">
                            <h2>Prescription Information</h2>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="details-group mb-4">
                                    <h4 class="details-label">Doctor Information</h4>
                                    <div class="details-value">
                                        <h5>{{ $prescription->doctor()->first()->name }}</h5>
                                        <p>Email: {{ $prescription->doctor()->first()->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="details-group mb-4">
                                    <h4 class="details-label">Patient Information</h4>
                                    <div class="details-value">
                                        <h5>{{ $prescription->patient()->first()->name }}</h5>
                                        <p>Email: {{ $prescription->patient()->first()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="details-group mb-4">
                                    <h4 class="details-label">Medication Details</h4>
                                    <div class="details-value">
                                        <p><strong>Duration:</strong> {{ $prescription->description }}</p>
                                        <p><strong>Created Date:</strong> {{ $prescription->created_at->format('Y-m-d H:i') }}</p>
                                        <p><strong>Last Updated:</strong> {{ $prescription->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="details-group">
                                    <h4 class="details-label">Additional Notes</h4>
                                    <div class="details-value">
                                        <p>{{ $prescription->description ?? 'No additional notes' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="mt-4">
                            <a href="{{ route('prescription.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection