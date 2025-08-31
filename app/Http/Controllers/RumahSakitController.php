<?php

namespace App\Http\Controllers;

use App\Models\RumahSakitModel;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    public function showDataRs()
    {
        $data = RumahSakitModel::all();
        return view('dashboard', compact('data'));
    }

    public function storeRs(Request $request)
    {
        $validated = $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat'           => 'required|string',
            'nomor_telepon'    => 'required|string|max:20',
            'email'            => 'required|email|unique:data_rs,email',
        ]);

        RumahSakitModel::create($validated);

        return redirect()->route('dashboard')->with('success', 'Rumah sakit berhasil ditambah!');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $data = RumahSakitModel::where('nama_rumah_sakit', 'ILIKE', "%{$query}%")
            ->orWhere('alamat', 'ILIKE', "%{$query}%")
            ->orWhere('email', 'ILIKE', "%{$query}%")
            ->get();

        return response()->json($data);
    }


    public function deleteRs($id)
    {
        $rs = RumahSakitModel::findOrFail($id);
        $rs->delete();

        return response()->json(['success' => true]);
    }
}
