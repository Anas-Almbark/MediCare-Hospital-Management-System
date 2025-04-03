<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Doctor</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $records = App\Models\MedicalRecord::where('patient_id', auth()->id())
                    ->with(['doctor'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            @endphp

            @forelse($records as $record)
                <tr>
                    <td>{{ $record->created_at->format('M d, Y') }}</td>
                    <td>{{ $record->type }}</td>
                    <td>Dr. {{ $record->doctor->name }}</td>
                    <td>{{ Str::limit($record->description, 50) }}</td>
                    <td>
                        <a href="{{ route('medical-records.show', $record->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        @if($record->file_path)
                            <a href="{{ route('medical-records.download', $record->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i> Download
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No medical records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>