<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Laporan::with('detail_pinjaman')->latest('created_at')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('DT_RowIndex', function ($data) {
                    return $data->id;
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y h:i:s');
                })
                ->toJson();
        }

        return view('pages.laporan.index');
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
        $validator = Validator::make($request->all(), [
            'jumlah_uang' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $laporan = new Laporan();
        $laporan->keterangan = $request->keterangan;
        $laporan->klasifikasi = 'Beban Operasional';
        $laporan->jumlah_uang = $request->jumlah_uang;

        if ($laporan->save()) {
            return back()->with(['success' => 'Data Laporan berhasil ditambahkan.']);
        } else {
            return response()->json(['message' => 'Terjadi kesalahan saat menambahkan data'], 500);
        }
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_uang' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $laporan = Laporan::find($request->id_laporan);
        if (!$laporan) {
            return back()->withErrors(['error' => 'Data laporan tidak ditemukan']);
        }

        if ($request->keterangan == 'Pendapatan Bunga') {
            return back()->withErrors(['error' => 'Data laporan pendapatan bunga tidak dapat di edit']);
        } else {
            $laporan->keterangan = $request->keterangan;
            $laporan->jumlah_uang = $request->jumlah_uang;

            if ($laporan->save()) {
                return back()->with(['success' => 'Data Laporan berhasil diperbarui.']);
            } else {
                return back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = Laporan::where('id', $id)->first();
        if ($laporan->keterangan == 'Pendapatan Bunga') {
            return back()->withErrors(['error' => 'Pendapatan bunga tidak dapat dihapus']);
        }
        $laporan->delete();
        return redirect()->route('laporan')->with('success', 'Data Laporan berhasil dihapus');
    }

    public function export(Request $request)
    {
        $data = Laporan::all();
        if ($data) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

            $laporan = Laporan::with('detail_pinjaman')->whereBetween('created_at', [$startDate, $endDate])->get();

            $tahun = Carbon::now()->format('Y');
            $tanggal_cetak = Carbon::now()->format('d/m/Y');

            $pendapatan_bunga = $laporan->where('keterangan', 'Pendapatan Bunga');
            $total_pendapatan_bunga = $pendapatan_bunga->sum('jumlah_uang');

            $beban_operasional = $laporan->where('klasifikasi', 'Beban Operasional');
            $total_beban_operasional = $beban_operasional->sum('jumlah_uang');

            $sisa_hasil_usaha = abs($total_pendapatan_bunga - $total_beban_operasional);

            $html = view('pages.report.laporan', compact('beban_operasional', 'tahun', 'tanggal_cetak', 'total_pendapatan_bunga', 'total_beban_operasional', 'sisa_hasil_usaha'))->render();

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $dompdf->stream('Laporan Laba/Rugi.pdf');
        } else {
            return back()->withErrors(['error' => 'Data Laporan SHU masih kosong. Silahkan coba kembali.']);
        }
    }
}
