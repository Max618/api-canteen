<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller {

	public function registerParent(Request $request){
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
			'name' => 'required',
			'phone' => 'required'
		]);
		$user = App\User::create([
            'email' => $request->get('email'),
            'password' => Hash::make($request->password)
		]);
		//dd($user);
		$user->parent()->create([
			'phone' => $request->get('phone'),
			'name' => $request->get('name')
		]);

		return response()->json($user);
	}

	public function login(Request $request){
		// grab credentials from the request
        //$credentials = $request->only('email', 'password');
        $credentials = [$request->get('email'), Hash::make($request->password)];

        //dd($credentials);

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
	}

}