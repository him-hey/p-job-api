<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    //
    public function create(Request $request){
        try {
            $validateCompany = Validator::make($request->all(),[
                'company_name' => 'required',
                'company_logo' => 'required',
                'company_address' => 'required',
                'company_website' => 'required',
                'company_email' => 'required',
                'password' => 'required',
            ]);
            if($validateCompany->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateCompany->errors(),
                ], 401);
            }
            $path = public_path('company_logo');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('company_logo');
            if ($file != null) {
                $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $fileName);
            }
            $company = Company::create(
                [
                    'company_name'=> $request->company_name,
                    'company_logo'=> $fileName,
                    'company_address'=> $request->company_address,
                    'company_website'=> $request->company_website,
                    'company_email'=> $request->company_email,
                    'password'=> Hash::make($request->password),
                ]
            );
            return response()->json([
                'status' => true,
                'message' => 'company create successful',
                'token' => $company->createToken("API TOKEN")->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function companyLogin(Request $request){
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
            $company = Company::where('company_email', $request->email)->first();
            if(Hash::check($request->password, $company->password)){
                return response()->json([
                    'status' => true,
                    'message' => 'company login successful',
                    'token' => $company->createToken("API TOKEN")->plainTextToken,
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'password does not match!',
                'error' => $validateUser->errors(),
            ], 401);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
