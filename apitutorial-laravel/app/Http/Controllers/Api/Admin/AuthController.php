<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Admin;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Auth;

class AuthController extends Controller
{

    use GeneralTrait;
    public function login(Request $request)
    {

        try {
            $rules = [
                // "email" => "required|exists:admins,email",
                "email" => "required",
                "password" => "required"
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login
            $credentials = $request->only(['email','password']) ;
            $token =  Auth::guard('admin-api')->attempt($credentials);
 
            if(!$token)
                return $this->returnError('E001','بيانات الدخول غير صحيحة');
 
              $admin = Auth::guard('admin-api')->user();
              $admin->api_token = $token;

              //return token
              return $this->returnData('admin',$admin);

        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function logout(Request $request)
    {
        $token = request()->header('auth-token');
        //dd($token);
        //$request->headers->set('auth-token', (string) $token, true);
        //$request->headers->set('Authorization', 'Bearer '.$token, true);
        if ($token) {
            //return $request -> headers;
            try {
              //return  $user = JWTAuth::toUser($token);
                JWTAuth::setToken($token)->invalidate(); //logout
                return $this-> returnSuccessMessage('logged out successfully') ;
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                //return $this->returnError('Token Invalide');
                return $this->returnError($e->getCode(), $e->getMessage());
            }
        }
        //return $this->returnError('Token Invlaide');
    }
}
