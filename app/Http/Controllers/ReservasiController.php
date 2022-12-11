<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'tipe_kamar' => ['required', 'string', 'max:255'],
    //         'nama_pemesan' => ['required', 'string', 'max:255'],
    //         'tanggal_masuk' => ['required', 'date'],
    //         'tanggal_keluar' => ['required','date','after:tanggal_masuk'],
    //         'status' => ['required','string','max:255']
    //     ]);
    // }

    // protected function create(array $data)
    // {
    //     return Reservasi::create([
    //         'no_kamar' => $data['name'],
    //         'nama_pemesan' => $data['email'],
    //         'tanggal_masuk' => $data['tanggal_masuk'],
    //         'tanggal_keluar' => $data['tanggal_keluar'],
    //         'status' => $data['status']
    //     ]);
    // }
    public function index()
    {
        $reservasi = Reservasi::get();
        return response()->json(["reservasi" => $reservasi], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe_kamar' => 'required|string|max:255',
            'nama_pemesan' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after:tanggal_masuk',
            'status' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $reservasi = Reservasi::create([
            'tipe_kamar' => $request->tipe_kamar,
            'nama_pemesan' => $request->nama_pemesan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_keluar' => $request->tanggal_keluar,
            'status' => $request->status
        ]);

        // event(new Reservasi($reservasi));

        return response()->json([
            'data' => $reservasi,
        ]);
    }

    // public function show($nama_user)
    // {
    //     $reservasi = Reservasi::find($nama_user);
    //     return response()::json(["reservasi"=>$reservasi]);
    // }

    public function show(Request $request, $nama_user)
    {

        $reservasi = Reservasi::where('nama_pemesan', $nama_user)->first();

        if (!$reservasi) {
            return response([
                'message' => 'Reservasi Kosong'
            ], 401);
        }



        return response()->json([
            'data' => $reservasi,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservasi  $reservasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'tipe_kamar' => 'required', 'string', 'max:255',
            'nama_pemesan' => 'required', 'string', 'max:255',
            'tanggal_masuk' => 'required', 'date',
            'tanggal_keluar' => 'required', 'date', 'after_or_equal:tanggal_masuk',
            'status' => 'required', 'string', 'max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // if ($validator->fails()) {
        //     return response()->json([
        //         'data' => [],
        //         'message' => $validator->errors(),
        //         'success' => false
        //     ]);
        // }
        $reservasi = Reservasi::find($id);
        $reservasi->tipe_kamar = $request->tipe_kamar;
        $reservasi->nama_pemesan = $request->nama_pemesan;
        $reservasi->tanggal_masuk = $request->tanggal_masuk;
        $reservasi->tanggal_keluar = $request->tanggal_keluar;
        $reservasi->status = $request->status;

        $reservasi->save();

        // Reservasi::find($nama_user)->update($request->all());

        return response()->json([
            'data' => $reservasi
        ]);
    }

    public function destroy(Request $request,$id)
    {
        $reservasi = Reservasi::find($id);
        $reservasi->delete();
        return [
            'message' => 'Deleted'
        ];
    }
}