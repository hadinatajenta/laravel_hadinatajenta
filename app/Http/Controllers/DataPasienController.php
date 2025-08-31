<?php

namespace App\Http\Controllers;

use App\Models\DataPasienModel;
use App\Models\RumahSakitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPasienController extends Controller
{
    public function index()
    {
        $rs   = RumahSakitModel::all();
        $data = DataPasienModel::with('rumah_sakit')->get();

        return view('DataPasien', compact('data', 'rs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat'      => 'required|string',
            'nomor_telepon'  => 'required|string|max:20',

            'rs_id'       => 'required|exists:data_rs,id',
        ]);

        DB::transaction(function () use ($validated) {
            DataPasienModel::create($validated);
        });

        return redirect()->route('pasien.index')->with('success', 'Pasien ditambahkan');
    }

    public function filter(Request $request)
    {
        $query = DataPasienModel::with('rumah_sakit');

        if ($request->filled('rs_id')) {
            $query->where('rs_id', $request->rs_id);
        }

        if ($request->filled('q')) {
            $q = strtolower($request->q);
            $query->whereRaw('LOWER(nama_pasien) LIKE ?', ["%{$q}%"]);
        }

        return response()->json($query->get());
    }

    public function destroy($id)
    {
        $pasien = DataPasienModel::findOrFail($id);

        DB::transaction(function () use ($pasien) {
            $pasien->delete();
        });

        return response()->json(['success' => true]);
    }
}
