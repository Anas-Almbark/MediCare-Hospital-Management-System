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
                        <a href="{{ route('prescription.show', $prescription->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('prescription.download', $prescription->id) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No prescriptions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>