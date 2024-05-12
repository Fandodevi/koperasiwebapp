<?php

namespace App\Charts;

use App\Models\Anggota;
use ArielMejiaDev\LarapexCharts\PieChart;

class JenisAnggotaChart
{
    protected $chart;

    public function __construct(PieChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): PieChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        $anggotaPendiri = Anggota::where('jenis_anggota', 'Pendiri')
            ->whereYear('tanggal_masuk', $tahun)
            ->whereMonth('tanggal_masuk', $bulan)
            ->count();
        $anggotaBiasa = Anggota::where('jenis_anggota', 'Biasa')
            ->whereYear('tanggal_masuk', $tahun)
            ->whereMonth('tanggal_masuk', $bulan)
            ->count();

        $this->chart->setTitle('Jenis Anggota Koperasi')
            ->setSubtitle('Total Anggota Pendiri = ' . $anggotaPendiri . ', ' . 'Total Anggota Biasa =' . $anggotaBiasa)
            ->addData([$anggotaPendiri, $anggotaBiasa])
            ->setLabels(['Anggota Pendiri', 'Anggota Biasa'])
            ->setColors(['#36A2EB', '#FF6384']);
        return $this->chart;
    }
}