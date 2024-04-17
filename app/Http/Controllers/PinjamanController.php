<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DetailPinjaman;
use App\Models\Pinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $simpanan = Pinjaman::with('anggota')->get();

        if ($request->ajax()) {
            return DataTables::of($simpanan)
                ->addColumn('DT_RowIndex', function ($simpanan) {
                    return $simpanan->id_users;
                })
                ->addColumn('nama', function ($simpanan) {
                    return $simpanan->anggota->nama;
                })
                ->toJson();
        }

        return view('pages.pinjaman.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pinjaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_anggota' => 'required|exists:anggota,id_anggota',
            'angsuran' => 'required|max:12|min:1',
            'nominal' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pinjaman_belum_lunas = Pinjaman::where('id_anggota', $request->id_anggota)
            ->where('status_pinjaman', 'Belum Lunas')
            ->first();
        if ($pinjaman_belum_lunas) {
            return redirect()->back()->with(['error' => 'Anggota memiliki pinjaman yang belum lunas.']);
        }

        try {
            DB::transaction(function () use ($request) {
                $angsuran_pokok = ceil($request->nominal / $request->angsuran);
                $bunga = ceil($angsuran_pokok * 0.01);
                $subtotal_angsuran = ceil($angsuran_pokok + $bunga);
                $sisa_lancar_angsuran = ceil($subtotal_angsuran * $request->angsuran);

                $pinjaman = new Pinjaman();
                $pinjaman->id_anggota = $request->id_anggota;
                $pinjaman->no_pinjaman = $this->generateMemberNumber();
                $pinjaman->total_pinjaman = $request->nominal;
                $pinjaman->angsuran = $request->angsuran;
                $pinjaman->sisa_lancar_keseluruhan = round($sisa_lancar_angsuran);
                $pinjaman->status_pinjaman = 'Belum Lunas';
                $pinjaman->tanggal_realisasi = Carbon::now();

                if ($pinjaman->save()) {
                    $id_pinjaman = $pinjaman->id_pinjaman;

                    for ($i = 1; $i <= $request->angsuran; $i++) {
                        $detail_pinjaman = new DetailPinjaman();
                        $detail_pinjaman->id_pinjaman = $id_pinjaman;
                        $detail_pinjaman->id_users = Auth::id();
                        $detail_pinjaman->angsuran_pokok = round($angsuran_pokok);
                        $detail_pinjaman->bunga = round($bunga);
                        $detail_pinjaman->subtotal_angsuran = round($subtotal_angsuran);
                        $detail_pinjaman->angsuran_ke_ = $i;

                        $tanggal_jatuh_tempo = Carbon::now()->addMonths($i)->startOfDay();
                        $detail_pinjaman->tanggal_jatuh_tempo = $tanggal_jatuh_tempo;

                        if (!$detail_pinjaman->save()) {
                            throw new \Exception('Gagal menyimpan data detail simpanan.');
                        }
                    }
                } else {
                    throw new \Exception('Gagal menyimpan data simpanan.');
                }
            });

            return redirect()->route('pinjaman')->with('success', 'Data pinjaman berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $pinjaman = Pinjaman::with(['anggota', 'detail_pinjaman'])->get();
        $detail_pinjaman = DetailPinjaman::with(['pinjaman', 'users'])->get();
        $rowData = [];

        if ($request->ajax()) {
            foreach ($detail_pinjaman as $row) {
                $pinjaman = $row->pinjaman;

                $rowData[] = [
                    'DT_RowIndex' => $row->id_pinjaman,
                    'id_pinjaman' => $pinjaman->id_pinjaman,
                    'tanggal_jatuh_tempo' => $row->tanggal_jatuh_tempo,
                    'angsuran_ke_' => $row->angsuran_ke_,
                    'angsuran_pokok' => $row->angsuran_pokok,
                    'bunga' => $row->bunga,
                    'subtotal_angsuran' => $row->subtotal_angsuran,
                    'status_pelunasan' => $row->status_pelunasan
                ];
            }

            return DataTables::of($rowData)->toJson();
        }
        $angsuran = DetailPinjaman::where('id_pinjaman', $id)->first();

        return view('pages.pinjaman.show', ['pinjaman' => $pinjaman, 'angsuran' => $angsuran]);
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

    private function generateMemberNumber()
    {
        $currentDate = now();
        $dateString = $currentDate->format('dmY');

        $randomNumber = '';
        for ($i = 0; $i < 6; $i++) {
            $randomNumber .= mt_rand(0, 9);
        }

        $memberNumber = 'P' . $dateString . $randomNumber;

        return $memberNumber;
    }
}