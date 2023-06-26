<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validateData->failed())
        {
            return response()->json([ 'error' => true , 'message' => $validateData->errors() ]);
        }
        else
        {
           $provider  = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $access_token = Str::random(65);

            return response()->json([
                'message' => 'Welcome Now provider'.$provider,
                'access_token' => $access_token ,
            ]);
           
        }
    }
    public function login(Request $request)
    {
        $validateData = Validator::make($request->all(),[
            'email' => 'required|max:50',
            'passsword' => 'required'
        ]);

        if($validateData->failed())
        {
            return response()->json(['message' => 'UnAuthorized',401]);
        }else
        {
            $cradintional = request(['email','password']);

            $token = auth('api')->attempt($cradintional);

            if(!$token)
            {
                return response()->json(['error'=>true ,'message' => 'UnAuthorized']);
            }

            return response()->json([
                'message' => 'Welcome Back',
                'access_token' => $token
            ]);

        }
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['error' => false , 'message' => 'Logout Successfully']);
    }
}
