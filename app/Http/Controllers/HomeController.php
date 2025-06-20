<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Kamar::where('status_tersedia', true);

        if ($request->filled('tipe_kamar')) {
            $query->where('tipe_kamar', 'like', '%' . $request->tipe_kamar . '%');
        }

        if ($request->filled('harga_max')) {
            $query->where('harga_per_malam', '<=', $request->harga_max);
        }

        $kamars = $query->get();
        return view('welcome', compact('kamars'));
    }
}