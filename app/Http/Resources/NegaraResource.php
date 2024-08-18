<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class NegaraResource extends JsonResource
{
    public $status;
    public $message;
    public $resource;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->formatResource($this->resource),
        ];        
    }

    protected function formatResource($resource)
    {
        if ($resource instanceof Collection) {
            return $resource->map(function ($negara) {
                return $this->negaraOutputFormatting($negara);
            })->all();
        }

        if (is_null($resource)) {
            return [];
        }

        return $this->negaraOutputFormatting($resource);
    }

    protected function negaraOutputFormatting($negara)
    {
        return [
            'id' => $negara->id,
            'nama_negara' => $negara->nama_negara,
            'kode_negara' => $negara->kode_negara,
            'created_at' => $negara->created_at,
            'direktorat' => [
                'id' => $negara->direktorat->id,
                'nama_direktorat' => $negara->direktorat->nama_direktorat,
            ],
            'region' => [
                'id' => $negara->region->id,
                'nama_kawasan' => $negara->region->nama_kawasan,
            ],
            'updated_at' => $negara->updated_at,
        ];
    }
}
