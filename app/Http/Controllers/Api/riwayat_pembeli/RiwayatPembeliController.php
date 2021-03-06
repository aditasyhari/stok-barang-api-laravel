<?php

namespace App\Http\Controllers\Api\riwayat_pembeli;

use App\Http\Controllers\Controller;
use App\riwayat_pembeli;
use App\data_pembeli;
use Illuminate\Http\Request;

class RiwayatPembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll()
    {
        //
        // $data = riwayat_pembeli::with(['data_pembeli'])->get();
        // $data = riwayat_pembeli::all();
        $data = riwayat_pembeli::with(['data_pembeli'])->get();
        return response()->json($data, 201);
    }

    public function index($id)
    {
        //
        // $data = riwayat_pembeli::with('data_pembeli')->get();
        $id_pembeli = data_pembeli::find($id);
        $data = riwayat_pembeli::whereIn('id_pembeli', $id_pembeli)->get();
        return response()->json(['jumlah' => count($data), 'show all' => $data], 201);
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
    public function store(Request $request, $id)
    {
        //
        $validateData = $request->validate([
            'tanggal_pembelian' => 'required',
            'nama_pembelian' => 'required',
            'jumlah_pembelian' => 'required',
            'harga_pembelian' => 'required',
            'dibayar' => 'required',
        ]);

        $id_pembeli = data_pembeli::find($id);

        if(isset($id_pembeli)) {

            $total_pembelian = $request->jumlah_pembelian * $request->harga_pembelian;
            $sisa = $request->dibayar - $total_pembelian;
            $id_pembeli = $id;

            $data = riwayat_pembeli::create([
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'nama_pembelian' => $request->nama_pembelian,
                'jumlah_pembelian' => $request->jumlah_pembelian,
                'harga_pembelian' => $request->harga_pembelian,
                'total_pembelian' => $total_pembelian,
                'dibayar' => $request->dibayar,
                'sisa' => $sisa,
                'id_pembeli' => $id_pembeli
            ]);

            return response()->json($data, 200);

        } else {
            return response([
                'status' => 'error',
                'massage' => 'id pembeli tidak ditemukan'
            ], 200);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\riwayat_pembeli  $riwayat_pembeli
     * @return \Illuminate\Http\Response
     */
    public function show($id, riwayat_pembeli $riwayat_pembeli)
    {
        //
        $data = riwayat_pembeli::find($id);

        return response()->json($data, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\riwayat_pembeli  $riwayat_pembeli
     * @return \Illuminate\Http\Response
     */
    public function edit(riwayat_pembeli $riwayat_pembeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\riwayat_pembeli  $riwayat_pembeli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id_riwayat)
    {
        //
        $id_pembeli = data_pembeli::find($id);
        if(isset($id_pembeli)) {

            $total_pembelian = $request->jumlah_pembelian * $request->harga_pembelian;
            $sisa = $request->dibayar - $total_pembelian;
            $id_pembeli = $id;
    
            $data = riwayat_pembeli::where('id', $id_riwayat)
                ->update([
                    'tanggal_pembelian' => $request->tanggal_pembelian,
                    'nama_pembelian' => $request->nama_pembelian,
                    'jumlah_pembelian' => $request->jumlah_pembelian,
                    'harga_pembelian' => $request->harga_pembelian,
                    'total_pembelian' => $total_pembelian,
                    'dibayar' => $request->dibayar,
                    'sisa' => $sisa,
                    'id_pembeli' => $id_pembeli
            ]);

            return response([
                'status' => 'success',
                'message' => 'riwayat berhasil diupdate',
                'data' => $data
            ]);

        } else {
            return response([
                'status' => 'error',
                'massage' => 'id pembeli tidak ditemukan'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\riwayat_pembeli  $riwayat_pembeli
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = riwayat_pembeli::destroy($id);
        return response()->json([
            'success' => 'riwayat berhasil di hapus'
        ], 200);
    }
}
