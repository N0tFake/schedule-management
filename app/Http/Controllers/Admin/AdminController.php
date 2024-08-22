<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\User;

class AdminController extends Controller
{
    public function defineRole(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'id_user' => 'required|integer',
                'role' => 'required|string',
            ]);
    
    
            if ($validator->fails())
            {
                return response()->json(['error' => $validator->errors()], 401);
            }
    
            $user = User::find($request->id_user);
            $user->role = $request->role;
            $user->save();
            
            return response()->json(['success' => 'Role updated'], 200);

        } catch (\Throwable $th) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }

    }
}
