<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index(){
        $perusahaan = Perusahaan::when(request()->search,
         function($query){
            $query->where('nama_perusahaan',
            'LIKE', '%' . request()->search)
            ->orWhereHas('bidang_perusahaan',
             request()->search, function($bidangPerusahaanQuery){
                $bidangPerusahaanQuery->where('bidang',
                'LIKE', '%',  request()->search . '%');
            });
        })
        ->with(['bidang_perusahaan'])
        ->latest()->paginate(5);


        if ($perusahaan) {
            return response()->json([
                'status' => true,
                'message' => 'List data perusahaan',
                'data' => $perusahaan
            ]);
        }
    }


    public function disabled($id){
        $perusahaan = Perusahaan::find($id);

        $perusahaan->update([
            'is_disabled' => true
        ]);


        if ($perusahaan) {
            return response()->json([
                'status' => true,
                'message' => 'Non aktifkan perusahaan berhasil',
                'data' => $perusahaan
            ]);
        }
    }
}
