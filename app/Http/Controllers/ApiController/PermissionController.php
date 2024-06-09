<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
  public function index(){

    $permission = Permission::when(request()->search, function($permission) {
        $permission = $permission->where('name', 'like', '%'. request()->search . '%');
    })->latest()->paginate(5);

    $permission->appends(['search' => request()->search]);

    return new PermissionResource(true, 'List Data Permssiion', $permission);
  }


  public function store(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:permssions,name'
    ]);

    if($validator->fails()){
        return response()->json($validator->errors());
    }

    $data = [
        'name' => $request->name,
    ];

    $permission = Permission::create($data);

    if ($permission) {
        return new PermissionResource(true, 'Data Permssion berhasil disimpan', $permission);
    }else{
        return new PermissionResource(false, 'Data Permssion gagal disimpan', $permission);
    }
  }


  public function update(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:permssions,name,' . $request->id
    ]);

    if($validator->fails()){
        return response()->json($validator->errors());
    }

    $data = [
        'name' => $request->name
    ];

    $permission = Permission::find($request->id);

    $permission->update($data);

    if ($permission) {
        return new PermissionResource(true, 'Data Permssion berhasil diubah', $permission);
    }else{
        return new PermissionResource(false, 'Data Permssion gagal diubah', $permission);
    }
  }


  public function hapus($id){
    $permission = Permission::find($id);

    $permission->delete();

    if ($permission) {
        return new PermissionResource(true, 'Data Permssion berhasil dihapus', $permission);
    }else{
        return new PermissionResource(false, 'Data Permssion gagal dihapus', $permission);
    }
  }


}
