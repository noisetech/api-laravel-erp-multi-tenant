<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\BidangPerusahanResource;
use App\Models\BidangPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidangPerusahaanController extends Controller
{
    public function index(){
        $bidang_perusahaan = BidangPerusahaan::when(request()->search, function($bidang_perusahaan){
            $bidang_perusahaan->where('bidang', 'LIKE', '%' . request()->search . '%');
        })->latest()->paginate(5);

        if ($bidang_perusahaan) {
            return new BidangPerusahanResource(true, 'Data bidang perusahaan berhasil ditampilkan', $bidang_perusahaan);
        }
        return new BidangPerusahanResource(true, 'Data bidang perusahaan gagal ditampilkan', $bidang_perusahaan);
    }

    public function simpan(Request $request){
        $validator = Validator::make($request->all(), [
            'bidang' => 'required|unique:bidang_perusahaan,bidang'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

       $akun_login = auth()->guard('api')->user();

       if ($akun_login == null || empty($akun_login)) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan'
            ], 400);
       }

       $data = $request->all();
       $data['bidang'] = $request->bidang;
       $data['create_by'] = json_encode([
        'full_name' => $akun_login->name
       ]);

       $bidang_perusahaan =  BidangPerusahaan::create($data);

      if ($bidang_perusahaan) {
        return new BidangPerusahanResource('true', 'Data bidang perusahan disimpan', $bidang_perusahaan);
      }else{
        return new BidangPerusahanResource('true', 'Data bidang perusahan gagal disimpan', $bidang_perusahaan);
      }
    }


    public function disabled($id){
        $bidang_perusahaan = BidangPerusahaan::findOrFail($id);

        $bidang_perusahaan->update([
            'is_disabled' => true
        ]);

        if($bidang_perusahaan){

        }

           if ($bidang_perusahaan) {
            return new BidangPerusahanResource('true', 'Data bidang perusahan di non aktifkan', $bidang_perusahaan);
          }else{
            return new BidangPerusahanResource('true', 'Data bidang perusahan gagal di non aktifkan', $bidang_perusahaan);
          }
    }


    public function enabled($id){
        $bidang_perusahaan = BidangPerusahaan::findOrFail($id);

        $bidang_perusahaan->update([
            'is_disabled' => false
        ]);

        if ($bidang_perusahaan) {
            return new BidangPerusahanResource('true', 'Data bidang perusahan di aktifkan', $bidang_perusahaan);
          }else{
            return new BidangPerusahanResource('true', 'Data bidang perusahan gagal gagal di aktifkan', $bidang_perusahaan);
          }
    }
}
