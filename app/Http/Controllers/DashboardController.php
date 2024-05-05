<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->id_role == 1) {
            $jumlahAnggota = Anggota::count();
            $jumlahPegawai = User::where('id_role', '=', '3')->count();
            $jumlahSimpanan = Simpanan::count();
            $jumlahPinjaman = Pinjaman::count();

            return view('pages.dashboard.index', compact('jumlahAnggota', 'jumlahPegawai', 'jumlahSimpanan', 'jumlahPinjaman'));
        } elseif (Auth::user()->id_role == 2) {
            $jumlahAnggota = Anggota::count();
            $jumlahPegawai = User::where('id_role', '=', '3')->count();
            $jumlahSimpanan = Simpanan::count();
            $jumlahPinjaman = Pinjaman::count();

            return view('pages.dashboard.index', compact('jumlahAnggota', 'jumlahPegawai', 'jumlahSimpanan', 'jumlahPinjaman'));
        } else {
            $jumlahAnggota = Anggota::count();
            $jumlahPegawai = User::where('id_role', '=', '3')->count();
            $jumlahSimpanan = Simpanan::count();
            $jumlahPinjaman = Pinjaman::count();

            return view('pages.dashboard.index', compact('jumlahAnggota', 'jumlahPegawai', 'jumlahSimpanan', 'jumlahPinjaman'));
        }
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