<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;
use Firebase\JWT\JWT;

class AuthController extends Controller {

    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    } 

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

		return response()->json(['status' => 'success']);
	}

	public function registerCook(Request $request){
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
			'name' => 'required'
		]);
		$user = App\User::create([
            'email' => $request->get('email'),
            'password' => Hash::make($request->password)
		]);
		//dd($user);
		$user->cook()->create([
			'phone' => $request->get('phone'),
			'name' => $request->get('name')
		]);

		return response()->json(['status' => 'success']);
	}

	public function login(Request $request){
		$this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::where('email', $request->get('email'))->first();

        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the 
            // below respose for now.
            return response()->json([
                'error' => 'Email does not exist.'
            ], 400);
        }

        // Verify the password and generate the token
        if (Hash::check($request->get('password'), $user->password)) {
        	$token = $this->jwt($user);
        	$user['api-key'] = $token;
        	$user->save();
            return response()->json([
                'token' => $token
            ], 200);
        }

        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);

	}

}