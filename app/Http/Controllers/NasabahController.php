<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome', [
            'nasabah' => Nasabah::orderBy('nama')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'file' => 'required|mimes:xlsx,csv',
        ];
        $pesan = [
            'file.required' => 'Silahkan upload file excel!',
            'file.mimes' => 'File yang anda upload harus berformat xlsx/csv'
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        } else {

            // Mengimpor file Excel
            Excel::import(new UsersImport, $request->file('file'));

            return response()->json(['success' => 'Data Berhasil Di Import']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Nasabah $nasabah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nasabah $nasabah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nasabah $nasabah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nasabah $nasabah)
    {
        Nasabah::destroy($nasabah->id);
        return response()->json(['success' => 'Nasabah Berhasil Dihapus!']);
    }

    public function dataTables(Request $request)
    {
        $query = Nasabah::all();
        return DataTables::of($query)->addColumn('action', function ($row) {
            $actionBtn =
                '
    <div class="d-flex justify-content-center gap-1">
    <button class="btn btn-rounded btn-sm btn-warning text-dark edit-button" title="Edit Data" data-id="' . $row->id . '"><i class="ri-edit-2-line"></i></button>
    <button class="btn btn-rounded btn-sm btn-danger delete-button" title="Delete Data" data-id="' . $row->id . '"><i class="ri-delete-bin-6-line"></i></button>
    <button class="btn btn-icon btn-sm btn-icon-end btn-outline-secondary mb-1" type="button">
                        <span>Download</span>
                        <i class="ri-download-2-line"></i>
                      </button>
    </div>
    ';
            return $actionBtn;
        })->make(true);
    }
}
