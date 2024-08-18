<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NegaraResource;
use App\Contract\NegaraRepositoryInterface;
use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NegaraController extends Controller
{
    public function __construct(
        private NegaraRepositoryInterface $repository
    ) 
    {
    }

    public function index()
    {
        $negara = $this->repository->getAllNegaras();
        return new NegaraResource(true, 'Data Negara Berhasil Diambil!', $negara);
    }
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_kawasan' => 'required|exists:kawasans,id',
            'id_direktorat' => 'required|exists:direktorats,id',
            'nama_negara' => 'required|string|max:255|unique:negaras,nama_negara',
            'kode_negara' => 'required|string|max:2|unique:negaras,kode_negara',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create negara
        $negara = $this->repository->createNegara($request->only([
            'id_kawasan',
            'id_direktorat',
            'nama_negara',
            'kode_negara',
        ]));

        //return response
        return new NegaraResource(true, 'Data Negara Berhasil Ditambahkan!', $negara);
    }

    public function show(int $id) 
    {
        $negara = $this->repository->getNegaraById($id);

        if (!$negara) {
            return response()->json([
                'success' => false,
                'message' => 'Data Negara tidak ditemukan!',
            ], 404);
        }

        return new NegaraResource(true, 'Data Negara Berhasil Diambil!', $negara);
    }

    public function destroy($id)
    {
        $deleted = $this->repository->deleteNegara($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Data Negara tidak ditemukan!',
            ], 404);
        }

        return new NegaraResource(true, 'Data Negara Berhasil Dihapus!', null);
    }
}
