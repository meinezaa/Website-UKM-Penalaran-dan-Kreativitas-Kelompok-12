<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TimController extends Controller
{
    public function index()
    {
        $bph = Team::where('kategori', 'bph')
            ->orderBy('urutan')
            ->get();

        $stafAhli = Team::where('kategori', 'staf_ahli')
            ->orderBy('urutan')
            ->get();

        return view('layouts.tim', compact(
            'bph',
            'stafAhli'
        ));
    }
}