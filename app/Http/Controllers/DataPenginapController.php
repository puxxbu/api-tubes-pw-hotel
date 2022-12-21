<?php

namespace App\Http\Controllers;

use App\Models\DataPenginap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataPenginapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datapenginap = DataPenginap::all();

        return response()->json([
            'data' => $datapenginap
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
                'nik' => 'required',
                'nama' => 'required',
                'tanggal_lahir' => 'required',
                'wilayah' => 'required',
                'jenis_kelamin' => 'required',
                'user_id' => 'required'
            ],
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $datapenginap = DataPenginap::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'wilayah' => $request->wilayah,
            'jenis_kelamin' => $request->jenis_kelamin,
            'user_id' => $request->user_id

        ]);

        return response()->json([
            'message' => 'Add Pesanan success',
            'data' => $datapenginap
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPenginap  $dataPenginap
     * @return \Illuminate\Http\Response
     */
    public function show($cari = null)
    {

        $data = DataPenginap::query()
            ->where('id', 'ilike', $cari)
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
     * @param  \App\Models\DataPenginap  $dataPenginap
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPenginap $dataPenginap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPenginap  $dataPenginap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPenginap $dataPenginap)
    {
        $dataPenginap->nama = $request->nama;
        $dataPenginap->wilayah = $request->wilayah;
        $dataPenginap->tanggal_lahir = $request->tanggal_lahir;
        $dataPenginap->nik = $request->nik;
        $dataPenginap->jenis_kelamin = $request->jenis_kelamin;
        $dataPenginap->user_id = $request->user_id;


        $dataPenginap->save();

        return response()->json([
            'data' => $dataPenginap,
            'message' => 'Update Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPenginap  $dataPenginap
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPenginap $dataPenginap)
    {
        $dataPenginap->delete();
        return response()->json([
            'message' => 'Pesanan Berhasil didelete'
        ], 204);
    }
}