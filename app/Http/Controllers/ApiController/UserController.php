<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUser(Request $request){
        $user = User::when(request()->search, function($query){
            $query->where('name', 'LIKE', '%' . request()->search . '%')
            ->orWhereHas('roles', function($roleQuery){
                $roleQuery->where('name', 'LIKE', '%' . request()->search . '%');
            });
        })->with(['roles.permissions'])->latest()->paginate(5);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'List data user berhasil ditampilkan',
                'data' => $user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'List data user gagal ditampilkan',
            'data' => $user
        ]);
    }
}
