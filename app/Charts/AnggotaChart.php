<?php

namespace App\Charts;

use App\Models\Anggota;
use ArielMejiaDev\LarapexCharts\LineChart;
use Carbon\Carbon;

class AnggotaChart
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

        $dataAnggota = [];
        $dataBulan = [];

        for ($i = 1; $i <= $bulan; $i++) {
            $jumlahAnggota = Anggota::whereYear('tanggal_masuk', $tahun)
                ->whereMonth('tanggal_masuk', $i)
                ->count();

            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataAnggota[] = $jumlahAnggota;
        }

        $totalAnggotaBulanIni = array_sum($dataAnggota);
        $subtitle = 'Total Anggota Baru Bulan Ini: ' . $totalAnggotaBulanIni;

        $this->chart->setTitle('Pertumbuhan Anggota')
            ->setSubtitle($subtitle)
            ->addData('Jumlah Anggota', $dataAnggota)
            ->setXAxis($dataBulan);

        return $this->chart;
    }
}
