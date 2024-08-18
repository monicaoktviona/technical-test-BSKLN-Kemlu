<?php

namespace App\Contract;

use App\Models\Negara;

interface NegaraRepositoryInterface 
{
    public function getAllNegaras();
    public function getNegaraById(int $id);
    public function createNegara(array $data);
    public function deleteNegara(int $id);
}