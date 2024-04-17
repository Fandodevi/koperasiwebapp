<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\DetailSimpanan;
use App\Models\simpanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SimpananController extends Controller
{

    public function index(Request $request)
    {
        $simpanan = simpanan::with('anggota')->get();

        if ($request->ajax()) {
            return DataTables::of($simpanan)
                ->addColumn('DT_RowIndex', function ($simpanan) {
                    return $simpanan->id_users;
                })
                ->addColumn('no_anggota', function ($simpanan) {
                    return $simpanan->anggota->no_anggota;
                })
                ->addColumn('nama', function ($simpanan) {
                    return $simpanan->anggota->nama;
                })
                ->addColumn('alamat', function ($simpanan) {
                    return $simpanan->anggota->alamat;
                })
                ->toJson();
        }

        return view('pages.simpanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.simpanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_anggota' => 'required|exists:anggota,id_anggota',
            'jenis_simpanan' => 'required|in:Simpanan Pokok,Simpanan Wajib,Simpanan Sukarela',
            'nominal' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $anggota = anggota::find($request->id_anggota);
        if ($anggota->simpanan) {
            return redirect()->back()->with(['error' => 'Anggota sudah memiliki simpanan.']);
        }

        try {
            DB::transaction(function () use ($request) {
                $simpanan = new Simpanan();
                $simpanan->id_anggota = $request->id_anggota;
                $simpanan->total_saldo = $request->nominal;

                if ($simpanan->save()) {
                    $id_simpanan = $simpanan->id_simpanan;

                    $detail_simpanan = new DetailSimpanan();
                    $detail_simpanan->id_simpanan = $id_simpanan;
                    $detail_simpanan->id_users = Auth::id();
                    $detail_simpanan->jenis_transaksi = 'Setor';
                    $detail_simpanan->subtotal_saldo = $request->nominal;

                    if ($request->jenis_simpanan == 'Simpanan Pokok') {
                        $detail_simpanan->simpanan_pokok = $request->nominal;
                    } elseif ($request->jenis_simpanan == 'Simpanan Wajib') {
                        $detail_simpanan->simpanan_wajib = $request->nominal;
                    } else {
                        $detail_simpanan->simpanan_sukarela = $request->nominal;
                    }

                    if (!$detail_simpanan->save()) {
                        throw new \Exception('Gagal menyimpan data detail simpanan.');
                    }
                } else {
                    throw new \Exception('Gagal menyimpan data simpanan.');
                }
            });

            return redirect()->route('simpanan')->with('success', 'Data simpanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = simpanan::find($id);
        $detail_simpanan_sukarela = DetailSimpanan::where('id_simpanan', '=', $id)->sum('simpanan_sukarela');

        if (!$data) {
            return back()->with(['error' => 'Simpanan tidak ditemukan. Silahkan coba kembali']);
        }

        $validator = Validator::make($request->all(), [
            'id_anggota' => 'required|exists:anggota,id_anggota',
            'jenis_simpanan' => 'required|in:Simpanan Pokok,Simpanan Wajib,Simpanan Sukarela',
            'nominal' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $saldoSebelumSetoran = $data->total_saldo;

            $jenisTransaksi = $request->jenis_transaksi;

            $jenisSimpanan = $request->jenis_simpanan;

            if ($jenisTransaksi == 'Setor') {
                $saldoSebelumSetoran += $request->nominal;
                $data->total_saldo += $request->nominal;
            } elseif ($jenisTransaksi == 'Tarik') {
                if ($jenisSimpanan == 'Simpanan Sukarela' && $request->nominal > $detail_simpanan_sukarela) {
                    throw new \Exception('Gagal menyimpan. Saldo sukarela tidak cukup');
                }
                $saldoSebelumSetoran -= $request->nominal;
                $data->total_saldo -= $request->nominal;
            }

            DB::transaction(function () use ($data, $saldoSebelumSetoran, $jenisTransaksi, $jenisSimpanan, $request) {
                $detail_simpanan = new DetailSimpanan();
                $detail_simpanan->id_simpanan = $data->id_simpanan;
                $detail_simpanan->id_users = Auth::id();
                $detail_simpanan->jenis_transaksi = $jenisTransaksi;
                $detail_simpanan->subtotal_saldo = $saldoSebelumSetoran;

                if ($jenisSimpanan == 'Simpanan Pokok') {
                    $detail_simpanan->simpanan_pokok = $request->nominal;
                } elseif ($jenisSimpanan == 'Simpanan Wajib') {
                    $detail_simpanan->simpanan_wajib = $request->nominal;
                } elseif ($jenisSimpanan == 'Simpanan Sukarela') {
                    $detail_simpanan->simpanan_sukarela = $request->nominal;
                }

                if (!$data->save() || !$detail_simpanan->save()) {
                    throw new \Exception('Gagal menyimpan perubahan saldo simpanan. Silahkan coba lagi');
                }
            });

            return redirect()->route('simpanan')->with('success', 'Data simpanan berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $simpanan = simpanan::with('anggota')->get();
        $detail_simpanan = DetailSimpanan::with(['simpanan', 'users'])->get();
        $rowData = [];

        if ($request->ajax()) {
            foreach ($detail_simpanan as $row) {
                $simpanan = $row->simpanan;
                $anggota = $simpanan->anggota;

                $rowData[] = [
                    'DT_RowIndex' => $row->id,
                    'id_simpanan' => $simpanan->id,
                    'no_anggota' => $anggota->no_anggota,
                    'nama_anggota' => $anggota->nama,
                    'alamat' => $anggota->alamat,
                    'tanggal_masuk' => $anggota->tanggal_masuk,
                    'total_saldo' => $simpanan->total_saldo,
                    'jenis_transaksi' => $row->jenis_transaksi,
                    'simpanan_pokok' => $row->simpanan_pokok,
                    'simpanan_wajib' => $row->simpanan_wajib,
                    'simpanan_sukarela' => $row->simpanan_sukarela,
                    'subtotal_saldo' => $row->subtotal_saldo,
                    'created_at' => $row->created_at->format('d-m-Y')
                ];
            }

            return DataTables::of($rowData)->toJson();
        }
        $setor = DetailSimpanan::where('jenis_transaksi', 'setor')->get();
        $tarik = DetailSimpanan::where('jenis_transaksi', 'tarik')->get();
        // $totalSetor = $detail_simpanan->where('jenis_transaksi', 'setor');
        // $totalTarik = $detail_simpanan->where('jenis_transaksi', 'tarik');

        $totalSimpananPokok = $setor->sum('simpanan_pokok');
        $totalSimpananWajib = $setor->sum('simpanan_wajib');
        $totalSimpananSukarela = $setor->sum('simpanan_sukarela');

        $totalPenarikanPokok = $tarik->sum('simpanan_pokok');
        $totalPenarikanWajib = $tarik->sum('simpanan_wajib');
        $totalPenarikanSukarela = $tarik->sum('simpanan_sukarela');

        $totalSimpananPokok -= $totalPenarikanPokok;
        $totalSimpananWajib -= $totalPenarikanWajib;
        $totalSimpananSukarela -= $totalPenarikanSukarela;
        // dd($totalSimpananPokok);
        return view('pages.simpanan.show', [
            'simpanan' => $simpanan,
            'total_simpanan_pokok' => $totalSimpananPokok,
            'total_simpanan_wajib' => $totalSimpananWajib,
            'total_simpanan_sukarela' => $totalSimpananSukarela
        ]);
    }
}