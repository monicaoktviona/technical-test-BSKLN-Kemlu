<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_kawasan',
        'id_direktorat',
        'nama_negara',
        'kode_negara',
    ];

    public function direktorat()
    {
        return $this->belongsTo(Direktorat::class, 'id_direktorat');
    }

    public function region()
    {
        return $this->belongsTo(Kawasan::class, 'id_kawasan');
    }
}
