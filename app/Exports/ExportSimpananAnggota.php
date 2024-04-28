<?php

namespace App\Exports;

use App\Models\DetailSimpanan;
use App\Models\Simpanan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportSimpananAnggota implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $simpanan = Simpanan::with(['anggota', 'detail_simpanan'])->where('id_simpanan', $this->id)->get();
        $setor = DetailSimpanan::where('id_simpanan', $this->id)
            ->where('jenis_transaksi', '=', 'Setor')
            ->get();
        $tarik = DetailSimpanan::where('id_simpanan', $this->id)
            ->where('jenis_transaksi', '=', 'Tarik')
            ->get();

        $totalSimpananPokok = $setor->sum('simpanan_pokok');
        $totalSimpananWajib = $setor->sum('simpanan_wajib');
        $totalSimpananSukarela = $setor->sum('simpanan_sukarela');

        $totalPenarikanPokok = $tarik->sum('simpanan_pokok');
        $totalPenarikanWajib = $tarik->sum('simpanan_wajib');
        $totalPenarikanSukarela = $tarik->sum('simpanan_sukarela');

        $totalSimpananPokok -= $totalPenarikanPokok;
        $totalSimpananWajib -= $totalPenarikanWajib;
        $totalSimpananSukarela -= $totalPenarikanSukarela;

        return view('exports.simpananAnggota', [
            'simpanan' => $simpanan,
            'totalSimpananPokok' => $totalSimpananPokok,
            'totalSimpananWajib' => $totalSimpananWajib,
            'totalSimpananSukarela' => $totalSimpananSukarela,
            'id' => $this->id
        ]);
    }
}