<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AnggotaController extends Controller
{

    public function index(Request $request)
    {
        $users = Anggota::with('simpanan', 'pinjaman')->get();

        if ($request->ajax()) {
            return DataTables::of($users)
                ->addColumn('DT_RowIndex', function ($user) {
                    return $user->id_anggota;
                })
                ->addColumn('has_simpanan', function ($user) {
                    return !empty($user->simpanan);
                })
                ->addColumn('has_pinjaman', function ($user) {
                    return !empty($user->pinjaman) && count($user->pinjaman) > 0;
                })
                ->toJson();
        }

        return view('pages.anggota.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.anggota.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|digits:16|unique:users',
            'nama' => 'required',
            'jeniskelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat' => 'required',
            'noTelp' => 'required|numeric',
            'pekerjaan' => 'required',
            'tanggalmasuk' => 'required',
            'jenisanggota' => 'required|in:Pendiri,Biasa',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $anggota = new Anggota();
        $anggota->nik = $request->nik;
        $anggota->no_anggota = $this->generateMemberNumber();
        $anggota->nama = $request->nama;
        $anggota->jenis_kelamin = $request->jeniskelamin;
        $anggota->alamat = $request->alamat;
        $anggota->no_telp = $request->noTelp;
        $anggota->pekerjaan = $request->pekerjaan;
        $anggota->tanggal_masuk = $request->tanggalmasuk;
        $anggota->jenis_anggota = $request->jenisanggota;
        $anggota->save();

        return redirect()->route('anggota')->with('success', 'Data anggota berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = anggota::find($id);
        return view('pages.anggota.edit', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anggota = anggota::find($id);

        if (!$anggota) {
            return back()->withErrors(['error' => 'Anggota tidak ditemukan. Silahkan coba kembali']);
        }

        $validator = Validator::make($request->all(), [
            'nik' => 'required|digits:16',
            'nama' => 'required',
            'jeniskelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat' => 'required',
            'noTelp' => 'required|numeric',
            'pekerjaan' => 'required',
            'tanggalmasuk' => 'required',
        ]);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $anggota->nik = $request->nik;
        $anggota->nama = $request->nama;
        $anggota->jenis_kelamin = $request->jeniskelamin;
        $anggota->alamat = $request->alamat;
        $anggota->no_telp = $request->noTelp;
        $anggota->pekerjaan = $request->pekerjaan;
        $anggota->tanggal_masuk = $request->tanggalmasuk;

        if ($anggota->save()) {
            return redirect()->route('anggota')->with('success', 'Data Anggota berhasil diperbarui.');
        } else {
            return back()->withErrors(['error' => 'Gagal menyimpan data. Silahkan coba kembali.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = anggota::where('id_anggota', $id)->first();
        $users->delete();

        return redirect()->route('anggota')->with('success', 'Anggota berhasil dihapus');
    }

    private function generateMemberNumber()
    {
        $currentDate = now();
        $dateString = $currentDate->format('dmY');

        $randomNumber = '';
        for ($i = 0; $i < 6; $i++) {
            $randomNumber .= mt_rand(0, 9);
        }

        $memberNumber = $dateString . $randomNumber;

        return $memberNumber;
    }
}