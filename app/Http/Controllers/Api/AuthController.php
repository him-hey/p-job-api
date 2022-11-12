<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        try {
            $validateUser = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if($validateUser->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors(),
                ], 401);
            }
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'username or password does not match!',
                    'error' => $validateUser->errors(),
                ], 401);
            }
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'user login successful',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function register(Request $request){
        try {
            $validateUser = Validator::make($request->all(),[
                'name' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);
            if($validateUser->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors(),
                ], 401);
            }
            $path = public_path('profile');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('profile');
            if ($file != null) {
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
            }
            $user = User::create(
                [
                    'name'=> $request->name,
                    'gender'=> $request->gender,
                    'phone'=> $request->phone,
                    'profile'=> $file,
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                ]
            );
            return response()->json([
                'status' => true,
                'message' => 'user create successful',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
