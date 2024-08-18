<?php

namespace App\Repositories;

use App\Contract\NegaraRepositoryInterface;
use App\Models\Negara;

class NegaraRepository implements NegaraRepositoryInterface 
{
    public function getAllNegaras() 
    {
        return Negara::with('region', 'direktorat')->latest()->get();
    }

    public function getNegaraById(int $id) 
    {
        return Negara::find($id);
    }

    public function createNegara(array $data)
    {
        return Negara::create($data);
    }

    public function deleteNegara(int $id)
    {
        $negara = Negara::find($id);
        
        if ($negara) {
            $negara->delete();
            return true;
        }

        return false;
    }
}