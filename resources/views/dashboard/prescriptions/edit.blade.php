@extends('dashboard')
@section('content')
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Edit Prescription</h4>
                <p class="mb-2">Update prescription information.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('prescription.update', $prescription->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <select name="doctor_id" class="form-control" id="inputDoctor" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $prescription->doctor == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="patient_id" class="form-control" id="inputPatient" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ $prescription->patient == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <textarea name="description" class="form-control" id="inputNotes" 
                            placeholder="Additional Notes" rows="3">{{ $prescription->description }}</textarea>
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Update Prescription</button>
                            <a href="{{ route('prescription.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .form-control {
        margin-bottom: 10px;
    }
    .form-control:focus {
        border-color: #0162e8;
        box-shadow: 0 0 0 0.2rem rgba(1, 98, 232, 0.25);
    }
    select.form-control {
        height: 40px;
    }
</style>
@endpush
