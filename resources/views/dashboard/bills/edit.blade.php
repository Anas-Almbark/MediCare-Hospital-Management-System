@extends('dashboard')
@section('content')
    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
        <div class="card box-shadow-0">
            <div class="card-header">
                <h4 class="card-title mb-1">Edit Bill</h4>
                <p class="mb-2">Update bill information.</p>
            </div>
            <div class="card-body pt-0">
                <form class="form-horizontal" action="{{ route('bill.update', $bill->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <select name="doctor_id" class="form-control" id="inputDoctor" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $bill->doctor == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="patient_id" class="form-control" id="inputPatient" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ $bill->patient == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" name="amount" class="form-control" id="inputAmount" 
                            placeholder="Amount" step="0.01" value="{{ $bill->amount }}" required />
                    </div>
                    <div class="form-group">
                        <textarea name="details" class="form-control" id="inputDetails" 
                            placeholder="Bill Details" rows="3" required>{{ $bill->description }}</textarea>
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <button type="submit" class="btn btn-primary">Update Bill</button>
                            <a href="{{ route('bill.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
