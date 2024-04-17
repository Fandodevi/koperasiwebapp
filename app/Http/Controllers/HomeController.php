<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        // $jumlah_cust = Customer::count(); 
        // $jumlah_aset = Product::count(); 
        // $jumlah_transaksi = Order::count(); 
        // return view('dashboard' , compact('jumlah_cust', 'jumlah_aset', 'jumlah_transaksi'));
        return view('dashboard');
        
    }
}
