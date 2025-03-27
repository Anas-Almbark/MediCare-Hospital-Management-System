@extends('dashboard')
@section('content')
    @include('dashboard.shard.successMsg')
<br>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Patients</h5>
                        <h2>{{ \App\Models\User::whereHas('roles', function($q) { $q->where('name', 'patient'); })->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Total Doctors</h5>
                        <h2>{{ \App\Models\Doctor::count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Total Appointments</h5>
                        <h2>{{ \App\Models\Appointment::count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>Total Lab Tests</h5>
                        <h2>{{ \App\Models\LabTest::count() }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Database Records</h4>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <select class="form-select" id="tableSelector" name="table">
                            <option value="" disabled selected>Select Table</option>
                            @foreach($tables as $table)
                                <option value="{{ $table }}">{{ ucwords(str_replace('_', ' ', $table)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr id="tableHeaders"></tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    $(document).ready(function() {
        let dataTable = null;

        function initializeDataTable(selectedTable) {
            if (dataTable) {
                dataTable.destroy();
                $('#dataTable').empty();
            }

            $.ajax({
                url: "{{ route('medical-record.getColumns') }}",
                type: 'GET',
                data: { table: selectedTable },
                success: function(columns) {
                    dataTable = $('#dataTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ordering: false,
                        colReorder: false,
                        fixedColumns: true,
                        searching: true,
                        ajax: {
                            url: "{{ route('medical-record.getData') }}",
                            type: 'GET',
                            data: function(d) {
                                d.table = selectedTable;
                                d.search = $('#searchInput').val();
                                d.status = $('#statusFilter').val();
                            }
                        },
                        columns: columns,
                        responsive: true,
                        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                        dom: '<"top"l>rt<"bottom"ip><"clear">',
                    
                    });

                    $('#searchInput').on('keyup', function() {
                        dataTable.search(this.value).draw();
                    });
                }
            });
        }

        $('#statusFilter').off('change').on('change', function() {
            if (dataTable) {
                let selectedStatus = $(this).val();
                dataTable.ajax.reload();
            }
        });

        $(document).on('change', '.dataTables_length select', function() {
            if (dataTable) {
                dataTable.page.len($(this).val()).draw();
            }
        });

        initializeDataTable('medical_records');

        // Table selector change handler
        $('#tableSelector').on('change', function() {
            let selectedTable = $(this).val();
            if (selectedTable) {
                initializeDataTable(selectedTable);
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    .loading {
        opacity: 0.5;
        pointer-events: none;
    }
    .card {
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border-radius: 10px;
        margin-bottom: 1rem;
    }
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
        position: sticky;
        top: 0;
    }
    .dataTables_wrapper .dataTables_filter {
        display: none;
    }
    #dataTable {
        width: 100% !important;
    }
    .table td, .table th {
        white-space: nowrap;
        min-width: 100px;
    }
</style>
@endpush
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let dataTable = null;

        function initDataTable(selectedTable, columns = []) {
            if (dataTable !== null) {
                dataTable.destroy();
                $('#dataTable thead').empty();
                $('#dataTable tbody').empty();
            }

            dataTable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: "{{ route('medical-record.getData') }}",
                    type: 'GET',
                    data: function(d) {
                        d.table = selectedTable;
                        d.search = $('#searchInput').val();
                        d.date = $('#dateFilter').val();
                        d.status = $('#statusFilter').val();
                    }
                },
                columns: columns,
                responsive: true,
                pageLength: 10,
                initComplete: function(settings, json) {
                $(".dataTables_filter").hide(); 
            }
            });

            return dataTable;
        }

        $('#tableSelector').on('change', function() {
            let selectedTable = $(this).val();
            if (selectedTable) {
                $('#dataTable').addClass('loading');
                
                $.ajax({
                    url: "{{ route('medical-record.getColumns') }}",
                    type: 'GET',
                    data: { table: selectedTable },
                    success: function(columns) {
                        dataTable = initDataTable(selectedTable, columns);
                        $('#dataTable').removeClass('loading');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#dataTable').removeClass('loading');
                        alert('خطأ في جلب البيانات');
                    }
                });
            }
        });

        $('#searchInput').on('keyup', function() {
            if (dataTable) {
                dataTable.search(this.value).draw();
            }
        });

        $('#dateFilter, #statusFilter').on('change', function() {
            if (dataTable) {
                dataTable.ajax.reload();
            }
        });
    });
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush
