<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\MedicalRecord;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $tables = [
            'users', 'doctors', 'appointments', 'prescriptions',
            'lab_tests', 'medical_records', 'bills', 'salaries','specializations','roles',' permissions'
        ];
        
        return view('dashboard.medical-records.index', compact('tables'));
    }

    public function getData(Request $request)
    {
        try {
            $table = $request->input('table', 'medical_records');
            $length = $request->input('length', 10);
            $start = $request->input('start', 0);
            $search = $request->input('search');
            $status = $request->input('status');
            
            $query = DB::table($table);
            
            if (!empty($status)) {
                $query->where('status', '=', $status);
            }
            
            if ($search) {
                $columns = Schema::getColumnListing($table);
                $query->where(function($q) use ($columns, $search) {
                    foreach ($columns as $column) {
                        $q->orWhereRaw("BINARY `$column` LIKE ?", ["%$search%"]);
                    }
                });
            }
            
            $totalRecords = DB::table($table)->count();
            
            $filteredRecords = $query->count();
            
            $results = $query->skip($start)
                            ->take($length)
                            ->get();
            
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getColumns(Request $request)
    {
        try {
            $table = $request->input('table', 'medical_records');

            $columnConfig = [
                'users' => [
                    'id' => 'ID',
                    'name' => 'Name',
                    'email' => 'Email',
                    'phone_number' => 'Phone Number',
                    'created_at' => 'Created Date'
                ],              
            ];

            $availableColumns = Schema::getColumnListing($table);

            if (isset($columnConfig[$table])) {
                $columns = array_intersect_key($columnConfig[$table], array_flip($availableColumns));
            } else {
                $columns = array_combine($availableColumns, array_map(function($col) {
                    return ucwords(str_replace('_', ' ', $col));
                }, $availableColumns));
            }

            $formattedColumns = [];
            foreach ($columns as $column => $title) {
                $formattedColumns[] = [
                    'data' => $column,
                    'name' => $column,
                    'title' => $title
                ];
            }

            return response()->json($formattedColumns);

        } catch (\Exception $e) {
            \Log::error('getColumns error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
