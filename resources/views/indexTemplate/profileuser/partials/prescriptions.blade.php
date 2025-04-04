<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $prescriptions = App\Models\Prescription::where('patient_id', auth()->id())
                    ->with(['doctor', 'appointment'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            @endphp

            @forelse($prescriptions as $prescription)
                <tr>
                    <td>Dr. {{ $prescription->doctor->name }}</td>
                    <td>{{ $prescription->created_at->format('M d, Y') }}</td>
                    <td>{{ Str::limit($prescription->description, 50) }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#prescriptionModal{{ $prescription->id }}">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <a href="{{ route('prescription.download', $prescription->id) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </td>
                </tr>

                <!-- Modal for Prescription Details -->
                <div class="modal fade" id="prescriptionModal{{ $prescription->id }}" tabindex="-1" aria-labelledby="prescriptionModalLabel{{ $prescription->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="prescriptionModalLabel{{ $prescription->id }}">Prescription Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold">Doctor Information</h6>
                                        <p>Name: Dr. {{ $prescription->doctor->name }}</p>
                                        <p>Date: {{ $prescription->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold">Patient Information</h6>
                                        <p>Name: {{ auth()->user()->name }}</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h6 class="fw-bold">Prescription Details</h6>
                                    <p>{{ $prescription->description }}</p>
                                </div>
                                @if($prescription->appointment)
                                <div class="mt-4">
                                    <h6 class="fw-bold">Appointment Information</h6>
                                    <p>Date: {{ $prescription->appointment->appointment_date }}</p>
                                    <p>Status: {{ ucfirst($prescription->appointment->status) }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('prescription.download', $prescription->id) }}" class="btn btn-success">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No prescriptions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>