<?php

namespace App\Http\Controllers;

use App\Helpers\Log;
use App\Models\SetSktm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SetSktmController extends Controller
{

    public function index()
    {
        $no_sktm = SetSktm::all();
        return view('pages.admin.data-sktm', compact('no_sktm'));
        // $test = 'test';
        // if ($sktm->isEmpty()) {
        //     $test = "data kosong";
        // }
        // dd($test);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'no_sktm' => ['required', 'numeric']
        ], [
            'no_sktm.required' => 'Nomor SKTM wajib diisi.',
            'no_sktm.numeric' => 'Inputan harus berupa angka.'
        ]);

        $inputData = SetSktm::create([
            'no_sktm' => $request->no_sktm,
        ]);

        Log::logSave('Menginput nomor SKTM: ' . $request->no_sktm);
        Alert::success('Data berhasil diinputkan.');
        return redirect()->route('data-sktm');
    }

    // Contoh di Controller
public function show($id)
{
    $pasien = Pasien::with('sktm')->find($id); // Pastikan Anda menggunakan ID yang benar

    if (!$pasien) {
        return redirect()->back()->with('error', 'Pasien tidak ditemukan.');
    }

    return view('your-view-name', compact('pasien'));
}
}
