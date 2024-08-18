<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Negara;
use App\Contract\NegaraRepositoryInterface;
use DataTables;

class NegaraController extends Controller
{
    public function __construct(
        private NegaraRepositoryInterface $repository
    ) 
    {
    }
    
    public function datatable()
    {
        if(\request()->ajax()){
            $data = $this->repository->getAllNegaras();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('datatable');
    }

    public function geomap()
    {
        $geojsonPath = public_path('data/countries.geo.json');
        $geojsonData = json_decode(file_get_contents($geojsonPath), true);

        $negaras = Negara::all();

        $direktoratMap = [];
        $direktoratColors = [];
        $colorPalette = [
            '#FF5733', '#33FF57', '#3357FF', '#F3FF33',
            '#FF33A5', '#33FFD8', '#D833FF', '#FF8C33',
            '#8CFF33', '#338CFF', '#FF3333', '#33FF33'
        ];
        $colorIndex = 0;

        foreach ($negaras as $negara) {
            $kodeNegara = $negara->kode_negara;
            $direktoratName = $negara->direktorat->nama_direktorat;
            $kawasanName = $negara->region->nama_kawasan;

            if (!isset($direktoratColors[$direktoratName])) {
                $direktoratColors[$direktoratName] = $colorPalette[$colorIndex % count($colorPalette)];
                $colorIndex++;
            }

            $direktoratMap[$kodeNegara] = [
                'direktorat' => $direktoratName,
                'color' => $direktoratColors[$direktoratName],
                'nama_negara' => $negara->nama_negara,
                'kawasan' => $kawasanName
            ];
        }

        foreach ($geojsonData['features'] as &$feature) {
            $countryCode = $feature['id'];

            if (isset($direktoratMap[$countryCode])) {
                $feature['properties']['direktorat'] = $direktoratMap[$countryCode]['direktorat'];
                $feature['properties']['color'] = $direktoratMap[$countryCode]['color'];
                $feature['properties']['nama_negara'] = $direktoratMap[$countryCode]['nama_negara'];
                $feature['properties']['kawasan'] = $direktoratMap[$countryCode]['kawasan'];
            } else {
                $feature['properties']['color'] = '#CCCCCC';
                $feature['properties']['direktorat'] = '-';
                $feature['properties']['kawasan'] = '-';
            }
        }

        $geojsonData = json_encode($geojsonData);
        return view('geomap', compact('geojsonData'));
    }    
}
