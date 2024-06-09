<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'detail_alamat' => 'required',
            'bidang_perusahaan' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|unique:users,email,except,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        DB::beginTransaction();

        try {

            $user = new User();
            $user->name = $request->nama_perusahaan;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $role = Role::find(3);
            $user->assignRole($role->name);

            $perusahaan = new Perusahaan();
            $perusahaan->nama_perusahaan = $request->nama_perusahaan;
            $perusahaan->users_id = $user->id;
            $perusahaan->bidang_perusahaan_id = $request->bidang_perusahaan;
            $perusahaan->no_telepon = $request->no_telepon;
            $perusahaan->alamat = $request->alamat;
            $perusahaan->detail_alamat = $request->detail_alamat;
            $perusahaan->is_disabled = false;
            $perusahaan->email = $request->email;
            $perusahaan->save();

            DB::commit();

            $data_perusahaan = Perusahaan::with(['bidang_perusahaan', 'akun_perusahaan'])->find($perusahaan);

            return response()->json([
                'status' => true,
                'message' => 'Data perusahaan berhasil disimpan',
                'data' => $data_perusahaan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan : ' . $e->getMessage()
            ]);
        }




    }
}
