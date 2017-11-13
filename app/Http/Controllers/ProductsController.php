<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Auth;

class ProductssController extends Controller
{
    private $user;

    public function __contruct(){
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function store(Request $request){
        $this->validade($request, [
            'name' => 'required',
            'price' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);
        if($this->user->cook()->product()->Create($request->all())){
            return response()->json(['status'=>'success']);
        }
        else{
            return response()->json(['status'=>'fail']);
        }
    }
}    

?>