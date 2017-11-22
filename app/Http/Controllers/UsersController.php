<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    
    /*public function __construct(){
         //  $this->middleware('auth:api');
    }*/

    /*public function authenticate(Request $request)
    {

    $this->validate($request, [
       'email' => 'required',
       'password' => 'required'
        ]);

    $user = User::where('email', $request->input('email'))->first();

    if(Hash::check($request->input('password'), $user->password)){
          $apikey = base64_encode(str_random(40));
          Users::where('email', $request->input('email'))->update(['api-key' => "$apikey"]);;
          return response()->json(['status' => 'success','api-key' => $apikey]);
	     }else{
	          return response()->json(['status' => 'fail'],401);
	     }
     }*/

	public function registerParent(Request $request){
		/*$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
			'name' => 'required',
			'phone' => 'required'
		]);*/
		return "eoq"
		dd($request);
		$user = User::create([
            'email' => $request->only('email'),
            'password' => bcrypt($request->only('password'))
		]);
		//dd($user);
		return response()->json($user);
	}
}    

?>