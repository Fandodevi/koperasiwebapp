<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::where('id_role', '=', '2')->with('role');

        if ($request->ajax()) {
            return DataTables::of($users)
                ->addColumn('DT_RowIndex', function ($user) {
                    return $user->id_users;
                })
                ->toJson();
        }

        return view('pages.pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|digits:16',
            'nama' => 'required',
            'email' => 'required|unique:users|email',
            'jeniskelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat' => 'required',
            'noTelp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pegawai = new User();
        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->password = Hash::make('12345678');
        $pegawai->jenis_kelamin = $request->jeniskelamin;
        $pegawai->alamat = $request->alamat;
        $pegawai->no_telp = $request->noTelp;
        $pegawai->save();

        return redirect()->route('pegawai')->with('success', 'Data pegawai berhasil disimpan.');
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
        $users = User::with('role')->find($id);
        return view('pages.pegawai.edit', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pegawai = User::find($id);

        if (!$pegawai) {
            return back()->withErrors(['error' => 'Pegawai tidak ditemukan. Silahkan coba kembali']);
        }

        $validator = Validator::make($request->all(), [
            'nik' => 'required|digits:16',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id_users',
            'jeniskelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat' => 'required',
            'noTelp' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->jenis_kelamin = $request->jeniskelamin;
        $pegawai->alamat = $request->alamat;
        $pegawai->no_telp = $request->noTelp;

        if ($pegawai->save()) {
            return redirect()->route('pegawai')->with('success', 'Data Pegawai berhasil diperbarui.');
        } else {
            return back()->withErrors(['error' => 'Gagal menyimpan data. Silahkan coba kembali.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::where('id_users', $id)->first();
        $users->delete();

        return redirect()->route('pegawai')->with('success', 'Pengguna berhasil dihapus');
    }
}