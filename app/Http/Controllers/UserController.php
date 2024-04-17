<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function page()
    {
        return redirect()->route('user');
    }
public function index(Request $request)
{
    if($request->has('search')){
        $data = user::where('name', 'LIKE', '%'.$request->search.'%')->paginate(5);
    }else{
    $data = user::paginate(5); }
    return view('user', compact('data'));

}
// public function tambah()
// {
//     return view('anggota');
// }

// public function insert(Request $request)
// {
//     $request->validate([
//         'name' => 'required',
//         'email' => 'required',
//         'password' => 'required',
//         'number' => 'required',
//     ]);

//     $validatedData['name'] = $request->name;
//     $validatedData['email'] = $request->email;
//     $validatedData['password'] =Hash::make($request->password);
//     $validatedData['number'] = $request->number;

//     User::create($validatedData); 
//     return redirect()->route('admin.admins')->with('success','Data Berhasil Ditambahkan');
// }

// public function tampil($id)
// {
//    $data = User::find($id);
//    return view('admintampildata', compact('data'));

// }

// public function update(Request $request, $id)
// {
//    $data = User::find($id);
//    $data->update($request->all());
//    return redirect()->route('admin.admins')->with('success','Data Berhasil Di Update');

// }

public function delete($id)
{
   $data = userq::find($id);
   $data->delete();
   return redirect()->route('user')->with('success','Data Berhasil Di  Hapus');
}
}
