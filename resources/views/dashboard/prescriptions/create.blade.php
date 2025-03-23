@extends('dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">{{ __('New Prescription') }}</h5>
                        <p class="text-muted mb-0">{{ __('Create a new prescription for patient') }}</p>
                    </div>
                    <a href="{{ route('prescription.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('prescription.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Doctor') }}</label>
                                <select name="doctor" class="form-select" id="inputDoctor" required>
                                    <option value="">-- {{ __('Select Doctor') }} --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }} - {{ $doctor->specialization }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Patient') }}</label>
                                <select name="patient" class="form-select" id="inputPatient" required>
                                    <option value="">-- {{ __('Select Patient') }} --</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Prescription Date') }}</label>
                                <input type="date" name="prescription_date" class="form-control" 
                                       value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Status') }}</label>
                                <select name="status" class="form-select" required>
                                    <option value="active">{{ __('Active') }}</option>
                                    <option value="completed">{{ __('Completed') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ __('Prescription Details') }}</label>
                                <textarea name="description" class="form-control" id="inputNotes" 
                                    rows="4" placeholder="{{ __('Enter prescription details, medications, and instructions...') }}" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> {{ __('Create Prescription') }}
                        </button>
                        <a href="{{ route('prescription.index') }}" class="btn btn-light">
                            <i class="fas fa-times me-1"></i> {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @endpush
@endsection
