<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::when(request()->search, function($query){
            $query->where('name', 'LIKE', '%' . request()->search . '%');
        })->with(['permissions'])->latest()->paginate(5);

        if($roles){
            return response()->json([
                'status' => true,
                'message' => 'List data role',
                'data' => $roles
            ]);
        }
    }

    public function simpan(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $roles = new Role();
        $roles->name = $request->name;
        $roles->guard_name = 'api';
        $roles->save();

        $roles->permissions()->attach($request->permission);


        $roles->permissions->pluck('name');

        if ($roles) {
            return response()->json([
                'status' => true,
                'message' => 'Roles berhasil disimpan',
                'data' => $roles
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Roles gagal disimpan',
            ]);
        }


    }
}
