<?php

namespace App\Http\Controllers;

use App\Models\DetailPinjaman;
use App\Models\DetailSimpanan;
use Illuminate\Http\Request;

class RekapTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $detail_simpanan = DetailSimpanan::all();
        $detail_pinjaman = DetailPinjaman::all();

        if ($request->ajax()) {
            
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