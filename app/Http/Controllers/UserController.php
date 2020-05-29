<?php

namespace App\Http\Controllers;

use App\User; 
use Validator;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Laravel\Passport\Client as OClient; 

class UserController extends Controller
{
    //
    public $successStatus = 200;

    public function login(Request $request) { 
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) { 
            $oClient = OClient::where('password_client', 1)->first();
            return $this->getTokenAndRefreshToken($request, $oClient, request('email'), request('password'));
        } 
        else { 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function register(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $password = $request->password;
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $oClient = OClient::where('password_client', 1)->first();        
        return $this->getTokenAndRefreshToken($request, $oClient, $user->email, $password);
    }

    public function getTokenAndRefreshToken($request, OClient $oClient, $email, $password) { 
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $email,
            'password' => $password,
            'scope' => '*',
        ]);

        // Fire off the internal request. 
        $token = Request::create(
            'oauth/token',
            'POST'
        );
        return \Route::dispatch($token);        
    }

    public function details() { 
        $user = Auth::user(); 
        return response()->json($user, $this->successStatus); 
    } 

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function unauthorized() { 
        return response()->json("unauthorized", 401); 
    }

    public function refreshToken(Request $request) { 
        $refresh_token = $request->header('Refreshtoken');
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;

        try {           
            $request->request->add([
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'scope' => '*'
            ]);

            $proxy = Request::create(
                'oauth/token',
                'POST'
            );

            return \Route::dispatch($proxy);

        } catch (Exception $e) {
            return response()->json("unauthorized", 401); 
        }
    }
}
