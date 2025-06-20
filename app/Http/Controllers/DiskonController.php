<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiskonController extends Controller
{
    public function index()
    {
        $diskons = Diskon::with('kamar')->get();
        return view('diskon.index', compact('diskons'));
    }

    public function create()
    {
        $kamars = Kamar::whereDoesntHave('diskon')->orWhereHas('diskon', function ($query) {
            $query->where('is_active', false)->orWhere('tanggal_selesai', '<', now());
        })->get();
        return view('diskon.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id',
            'kode_diskon' => 'required|unique:diskon',
            'persentase_diskon' => 'required|numeric|min:0|max:100',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'is_active' => 'required|boolean',
        ], [
            'kamar_id.required' => 'Kamar wajib dipilih.',
            'kode_diskon.required' => 'Kode diskon wajib diisi.',
            'kode_diskon.unique' => 'Kode diskon sudah digunakan.',
            'persentase_diskon.required' => 'Persentase diskon wajib diisi.',
            'persentase_diskon.numeric' => 'Persentase diskon harus berupa angka.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
        ]);

        Diskon::create($request->all());
        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil ditambahkan.');
    }

    public function edit(Diskon $diskon)
    {
        $kamars = Kamar::where('id', $diskon->kamar_id)
            ->orWhereDoesntHave('diskon')
            ->orWhereHas('diskon', function ($query) {
                $query->where('is_active', false)->orWhere('tanggal_selesai', '<', now());
            })->get();
        return view('diskon.edit', compact('diskon', 'kamars'));
    }

    public function update(Request $request, Diskon $diskon)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,id',
            'kode_diskon' => 'required|unique:diskon,kode_diskon,' . $diskon->id,
            'persentase_diskon' => 'required|numeric|min:0|max:100',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'is_active' => 'required|boolean',
        ]);

        $diskon->update($request->all());
        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    public function destroy(Diskon $diskon)
    {
        $diskon->delete();
        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil dihapus.');
    }
}