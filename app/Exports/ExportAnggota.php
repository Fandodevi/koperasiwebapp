<?php

namespace App\Exports;

use App\Models\Anggota;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAnggota implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.anggota', [
            'anggota' => Anggota::all()
        ]);
    }
}