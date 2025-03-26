@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Lab Test Results</h4>
                    </div>
                    <div class="card-body">
                        <div class="pdf-container" style="height: 800px;">
                            @if ($labTest->result)
                                <embed src="{{ Storage::url($labTest->result) }}" type="application/pdf" width="100%"
                                    height="100%" style="border: 1px solid #ccc;">
                            @else
                                <div class="alert alert-info">
                                    No PDF file available for this lab test.
                                </div>
                            @endif
                        </div>
                        @if (isset($labTest->pdf_path))
                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $labTest->pdf_path) }}" class="btn btn-success" download>
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
