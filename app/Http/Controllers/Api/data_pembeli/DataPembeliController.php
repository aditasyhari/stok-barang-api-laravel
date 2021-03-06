<?php

namespace App\Http\Controllers\Api\data_pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\data_pembeli;
use App\User;
use Illuminate\Http\Request;

class DataPembeliController extends Controller
{
    public function index()
    {
        //
        // $data = data_pembeli::all();
        $data = data_pembeli::with(['user'])->get();
        return response()->json($data, 201);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'nama_pembeli' => 'required',
            'alamat_pembeli' => 'required',
            'nomor_hp' => 'required',
        ]);

        $id = Auth::id();

        $data = data_pembeli::create([
            'nama_pembeli' => $request->nama_pembeli,
            'alamat_pembeli' => $request->alamat_pembeli,
            'nomor_hp' => $request->nomor_hp,
            'id_user' => $id
        ]);

        return response()->json($data, 200);
    }

    public function show($id)
    {
        //
        $data = data_pembeli::find($id);
        return response()->json($data, 201);
    }

    public function edit(data_pembeli $data_pembeli)
    {
        //
    }


    public function update(Request $request, data_pembeli $data_pembeli)
    {
        //
        $id = Auth::id();

        $data = data_pembeli::where('id', $data_pembeli->id)
                ->update([
                    'nama_pembeli' => $request->nama_pembeli,
                    'alamat_pembeli' => $request->alamat_pembeli,
                    'nomor_hp' => $request->nomor_hp,
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
    public function destroy(data_pembeli $data_pembeli)
    {
        //
        $data = data_pembeli::destroy($data_pembeli->id);
        return response()->json([
            'success' => 'barang berhasil di hapus'
        ], 200);
    }
}
