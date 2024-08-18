<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KawasanResource;
use App\Models\Kawasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KawasanController extends Controller
{
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_direktorat' => 'required|exists:direktorats,id',
            'nama_kawasan' => 'required|string|max:255|unique:kawasans,nama_kawasan',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create kawasan
        $kawasan = Kawasan::create([
            'id_direktorat'     => $request->id_direktorat,
            'nama_kawasan'   => $request->nama_kawasan,
        ]);

        //return response
        return new KawasanResource(true, 'Data Kawasan Berhasil Ditambahkan!', $kawasan);
    }}
