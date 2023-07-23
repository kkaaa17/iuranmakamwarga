<?php

namespace Modules\Iuran\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Iuran\Entities\Iuran;
use Modules\Warga\Entities\Warga;

class IuranController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = Iuran::leftjoin('warga', 'warga.nik', '=', 'iuran.nik')
                        ->get();
        $datawarga= Warga::all();
        // dd($data);
        return view('iuran::index', compact('data','datawarga')); 
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('iuran::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nik'     => 'required|min:5',
            'bayar'   => 'required',
            'totalbayar' => 'required|min:5',
            'tglbayar' => 'required|min:5',
        ]);

        if ($validasi->fails()) {
            return '<script>alert("gagal"); location.href="'. url('/iuran').'"</script>';
        } else {
            $warga=Warga::where('nik',$request->nik)->first();

            Warga::where('nik',$request->nik)->update([ 
                'iuran'       => $warga->iuran+$request->bayar,

            ]);

            Iuran::create([
                'nik'       => $request->nik,
                'totalbayar'   => $request->totalbayar,
                'bulanke'   => 0,
                'tglbayar'   => $request->tglbayar,

            ]);
            return redirect('iuran');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('iuran::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('iuran::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        
        $iuran=Iuran::where('id',$id)->first();
        $warga=Warga::where('nik',$iuran->nik)->first();
        $bayar = $iuran->totalbayar/20000;

        Warga::where('nik',$iuran->nik)->update([ 
            'iuran'       => $warga->iuran-$bayar,

        ]);

        Iuran::where('id',$id)->delete();
        return redirect('iuran');
        //
    }
}
