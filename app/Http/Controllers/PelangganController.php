<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function showall()
    {
        $pelanggans = Pelanggan::all();
        return response()->json($pelanggans);
    }
}
