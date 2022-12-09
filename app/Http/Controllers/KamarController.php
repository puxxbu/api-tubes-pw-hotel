<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamars = Kamar::all();

        return response()->json([
            'data' => $kamars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
                'harga' => 'required',
                'jenis_kamar' => 'required',
                'jumlah_tersedia' => 'required',
            ],
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kamar = Kamar::create([

            'harga' => $request->harga,
            'jenis_kamar' => $request->jenis_kamar,
            'jumlah_tersedia' => $request->jumlah_tersedia,

        ]);

        return response()->json([
            'message' => 'Add Pesanan success',
            'data' => $kamar
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show($cari = null)
    {
        $data = Kamar::query()
            ->orWhere('harga', 'ilike', '%' . $cari . '%')
            ->orWhere('jenis_kamar', 'ilike', '%' . $cari . '%')
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
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamar $kamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kamar $kamar)
    {
        $kamar->harga = $request->harga;
        $kamar->jenis_kamar = $request->jenis_kamar;
        $kamar->jumlah_tersedia = $request->jumlah_tersedia;


        $kamar->save();

        return response()->json([
            'data' => $kamar,
            'message' => 'Update Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return response()->json([
            'message' => 'Kamar Berhasil didelete'
        ], 204);
    }
}