<?php

namespace App\Http\Controllers;

use App\Models\PesananMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananMakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanans = PesananMakanan::all();

        return response()->json([
            'data' => $pesanans
        ]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'nama_pesanan' => 'required',
                'harga' => 'required',
                // 'jam_antar' => 'required',
                'user_id' => 'required'
            ],
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pesanan = PesananMakanan::create([
            'nama_pesanan' => $request->nama_pesanan,
            'harga' => $request->harga,
            // 'jam_antar' => $request->jam_antar,
            'user_id' => $request->user_id,

        ]);

        return response()->json([
            'message' => 'Add Pesanan success',
            'data' => $pesanan
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PesananMakanan  $pesananMakanan
     * @return \Illuminate\Http\Response
     */
    public function show($cari = null)
    {
        $data = PesananMakanan::query()
            ->where('nama_pesanan', 'ilike', '%' . $cari . '%')
            ->orWhere('harga', 'ilike', '%' . $cari . '%')
            ->orWhere('jam_antar', 'ilike', '%' . $cari . '%')
            ->orWhere('id', 'ilike', $cari)
            ->get();
        if (count($data) > 1) {
            return response()->json([
                'status' => 200,
                'error' => "false",
                'message' => '',
                'totaldata' => count($data),
                'data' => $data,
            ], 200);
        } else if (count($data) == 1) {
            return response()->json([
                'status' => 200,
                'error' => "false",
                'message' => '',
                'totaldata' => count($data),
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'error' => "true",
                'message' => 'Data not found',
                'data' => $data,
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PesananMakanan  $pesananMakanan
     * @return \Illuminate\Http\Response
     */
    public function edit(PesananMakanan $pesananMakanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PesananMakanan  $pesananMakanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PesananMakanan $pesananMakanan)
    {
        $pesananMakanan->nama_pesanan = $request->nama_pesanan;
        $pesananMakanan->harga = $request->harga;
        // $pesananMakanan->jam_antar = $request->jam_antar;
        $pesananMakanan->user_id = $request->user_id;

        $pesananMakanan->save();

        return response()->json([
            'data' => $pesananMakanan,
            'message' => 'Update Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PesananMakanan  $pesananMakanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PesananMakanan $pesananMakanan)
    {
        $pesananMakanan->delete();
        return response()->json([
            'message' => 'Pesanan Berhasil didelete'
        ], 204);
    }
}