<?php

namespace App\Http\Controllers\API;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth;


/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){

        $password = base64_decode(request('password'));
        if(Auth::attempt(['email' => request('email'), 'password' => $password])){

            $user = Auth::user();
           if($user !== null) {
                $tokenObj = $user->createToken('cms');
                $success['token'] = $tokenObj->accessToken;

                return response()->json(['user' => $user, 'success' => $success], $this->successStatus);
            }
            return response()->json(['error'=>'User Not Found'], 401);
        }
        else{
            return response()->json(['error'=>'Unauthorised! Incorrect username or password.'], 401);
        }
    }

}
