<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        
        try{
            $credentials = $request->only(['email', 'password']);
            //dd($credentials);
            //if(!JWTAuth::attempt($credentials)) {
            //    return $this->error("Your Email & Password doesn't match!", null, 401);
            //}

            $user = User::where('email', $credentials['email'])->first();
            //dd($user);
            $payload = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'status' => $user->status === 1 ? 'active' : "inactive"
            ];

            $token = JWTAuth::customClaims($payload)->attempt(['email' => $user->email, 'password' => $credentials['password']]);

            return $this->success($token, "User Login Successfully", 200);

        } catch(Exception $e) {
            return $this->error($e->getMessage() ? $e->getMessage() : "Something went wrong!", null, $e->getCode() ? $e->getCode() : 500);
        }
    }
    

    public function register(Request $request){

        try{
            $validateUser = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users,email,except,id',
                'password' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]);

            if($validateUser->fails()){
                return $this->error('Validation Error',$validateUser->errors(), 422);
            }

            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
            ]); 

            return $this->success($user, "User Created Successfully", 201);
        }catch(Exception $e){
            return $this->error($e->getMessage() ? $e->getMessage() : "Internal server error!", null, $e->getCode() ? $e->getCode() : 500);
        }
    }
}
