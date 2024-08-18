<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DirektoratResource;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DirektoratController extends Controller
{
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_direktorat' => 'required|string|max:255|unique:direktorats,nama_direktorat',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create direktorat
        $direktorat = Direktorat::create([
            'nama_direktorat'     => $request->nama_direktorat,
        ]);

        //return response
        return new DirektoratResource(true, 'Data Direktorat Berhasil Ditambahkan!', $direktorat);
    }
}
