<?php

namespace App\Http\Controllers\Api\stok_barang;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\stok_barang;

class stok_barangController extends Controller
{
    public function index()
    {
        //
        $data = stok_barang::all();
        $data = stok_barang::with(['user'])->get();
        return response()->json($data, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'asal_barang' => 'required',
            'jumlah_barang' => 'required',
            'tanggal' => 'required',
        ]);

        $id = Auth::id();

        $data = stok_barang::create([
            'nama_barang' => $request->nama_barang,
            'asal_barang' => $request->asal_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'tanggal' => $request->tanggal,
            'id_user' => $id
        ]);

        return response()->json($data, 200);
    }

    public function show($id)
    {
        //
        $data = stok_barang::find($id);
        return response()->json($data, 201);
    }

    public function edit(stok_barang $stok_barang)
    {
        //
    }


    public function update(Request $request, stok_barang $stok_barang)
    {
        //
        $id = Auth::id();

        $data = stok_barang::where('id', $stok_barang->id)
                ->update([
                    'nama_barang' => $request->nama_barang,
                    'asal_barang' => $request->asal_barang,
                    'jumlah_barang' => $request->jumlah_barang,
                    'tanggal' => $request->tanggal,
                    'id_user' => $id
                ]);
        
        return response([
            'status' => 'OK',
            'massage' => 'Data berhasil dirubah',
            'update-data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\riwayat_pembeli  $riwayat_pembeli
     * @return \Illuminate\Http\Response
     */
    public function destroy(stok_barang $stok_barang)
    {
        //
        $data = stok_barang::destroy($stok_barang->id);
        return response()->json([
            'success' => 'barang berhasil di hapus'
        ], 200);
    }
}
