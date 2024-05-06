<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DetailPinjaman;
use App\Models\DetailSimpanan;
use App\Models\HistoryTransaksi;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RekapTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rekap = HistoryTransaksi::with('users', 'detail_simpanan', 'pinjaman', 'detail_pinjaman')->orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            $rowData = [];
            $iteration = 1;

            foreach ($rekap as $item) {
                $totalSaldo = 0.00;

                if ($item->id_detail_simpanan != null) {
                    $detail_simpanan = DetailSimpanan::find($item->id_detail_simpanan);
                    $simpanan_pokok = $detail_simpanan->simpanan_pokok;
                    $simpanan_wajib = $detail_simpanan->simpanan_wajib;
                    $simpanan_sukarela = $detail_simpanan->simpanan_sukarela;
                    $totalSaldo = $simpanan_pokok + $simpanan_wajib + $simpanan_sukarela;
                } elseif ($item->id_pinjaman != null) {
                    $pinjaman = Pinjaman::find($item->id_pinjaman);
                    $totalSaldo = $pinjaman->total_pinjaman;
                } else {
                    $detail_pinjaman = DetailPinjaman::find($item->id_detail_pinjaman);
                    $totalSaldo = $detail_pinjaman->angsuran_pokok;
                }

                $rowData[] = [
                    'DT_RowIndex' => $iteration,
                    'nama_pengguna' => $item->users->nama,
                    'tipe_transaksi' => $item->tipe_transaksi,
                    'tanggal' => $item->created_at->format('d-m-Y h:i:s'),
                    'total_saldo' => $totalSaldo,
                ];

                $iteration++;
            }

            return DataTables::of($rowData)->toJson();
        }

        return view('pages.rekap.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}