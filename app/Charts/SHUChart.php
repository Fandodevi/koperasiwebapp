<?php

namespace App\Charts;

use App\Models\Laporan;
use ArielMejiaDev\LarapexCharts\LineChart;
use Carbon\Carbon;

class SHUChart
{
    protected $chart;

    public function __construct(LineChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        $dataPendapatanBunga = [];
        $dataBebanOperasional = [];
        $dataBulan = [];
        $sisa_hasil_usaha = [];

        for ($i = 1; $i <= $bulan; $i++) {
            $laporan = Laporan::with('detail_pinjaman')
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->get();

            $pendapatan_bunga = $laporan->where('keterangan', 'Pendapatan Bunga');
            $total_pendapatan_bunga = $pendapatan_bunga->sum('jumlah_uang');

            $beban_operasional = $laporan->where('klasifikasi', 'Beban Operasional');
            $total_beban_operasional = $beban_operasional->sum('jumlah_uang');

            $dataPendapatanBunga[] = $total_pendapatan_bunga;
            $dataBebanOperasional[] = $total_beban_operasional;
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $sisa_hasil_usaha[] = $total_pendapatan_bunga - $total_beban_operasional;
        }

        $this->chart->setTitle('Sisa Hasil Usaha')
            ->setSubtitle('Total Sisa Hasil Usaha Sekarang Rp ' . number_format($sisa_hasil_usaha[$bulan - 1], 2, ',', '.'))
            ->addData('SHU', $sisa_hasil_usaha)
            ->addData('Pendapatan Bunga', $dataPendapatanBunga)
            ->addData('Beban Operasional', $dataBebanOperasional)
            ->setXAxis($dataBulan);

        return $this->chart;
    }
}