<?php

namespace Modules\Warga\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Warga\Entities\Warga;

class WargaController extends Controller
{

    public function index()
    {
        $data = Warga::all();
        // dd($data);
        return view('warga::index', compact('data')); 
    }
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nik'     => 'required|min:5',
            'nama'   => 'required|min:5',
            'ttl' => 'required|min:5',
            'alamat' => 'required|min:5',
            'jk' => 'required|min:1',
            'nohp' => 'required|min:5',
    ]);

    if ($validasi->fails()) {
        return '<script>alert("gagal"); location.href="'. url('/warga') .'"</script>';
    } else {
        Warga::create([
            'nik'       => $request->nik,
            'nama'   => $request->nama,
            'ttl'   => $request->ttl,
            'alamat'   => $request->alamat,
            'jk'   => $request->jk,
            'nohp'   => $request->nohp,
            'iuran' =>0
        ]);
        return redirect('warga');
    }
        //
    }
    public function show($id)
    {
        return view('warga::show');
    }
    public function edit($nik)
    {
        $data = Warga::where('nik',$nik)->first();
        return view('warga::edit', compact('data'));
    }
    public function update(Request $request, $nik)
    {
        $validasi = Validator::make($request->all(), [
            'nik'     => 'required|min:5',
            'nama'   => 'required|min:5',
            'ttl' => 'required|min:5',
            'alamat' => 'required|min:5',
            'jk' => 'required|min:1',
            'nohp' => 'required|min:5',
    ]);

    if ($validasi->fails()) {
        return '<script>alert("gagal"); location.href="'. url('/warga/edit/'.$nik) .'"</script>';
    } else {
        Warga::where('nik',$nik)->update([ 
            'nik'       => $request->nik,
            'nama'   => $request->nama,
            'ttl'   => $request->ttl,
            'alamat'   => $request->alamat,
            'jk'   => $request->jk,
            'nohp'   => $request->nohp,
        ]);
        return redirect('warga');
    }
        //
    }
    public function destroy($nik)
    {
        Warga::where('nik',$nik)->delete();
        return redirect('warga');
        //
    }
}
