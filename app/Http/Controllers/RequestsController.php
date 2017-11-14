<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Request as Pedido;
use App\Users;
use Auth;
use Carbon\Carbon;

class RequestsController extends Controller
{
	private $user;

    public function __contruct(){
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function store(Request $request){
        $this->validade($request, [
            'list' => 'required',
            'f_price' => 'required',
            'delivery_date' => 'required',
            'type' => 'required'
        ]);
        if($this->user->parent()->request()->Create($request->all())){
            return response()->json(['status'=>'success']);
        }
        else{
            return response()->json(['status'=>'fail']);
        }
    }

    public function get(Pedido $pedido){
        if($pedido && !empty($pedido)){
            return response()->json(['status'=>'success', 'request'=>$pedido]);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown request']);
        }
    }

    public function getRequests(){
        if($pedidos = Pedido::where(['date_delivery' => Carbon::now(), 'delivered' => 'false'])){
            return response()->json(['status' =>'success','requests'=>$pedidos]);
        }
        else{
            return response()->json(['status'=> 'fail','message'=>'unkown requests']);
        }
    }

    public function index(){
        if($pedidos = Pedido::all()){
            return response()->json(['status' =>'success','requests'=>$pedidos]);
        }
        else{
            return response()->json(['status'=> 'fail','message'=>'unkown requests']);
        }
    }

    public function delete(Pedido $pedido){
        if($pedido->delete()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown request']);
        }
    }

    public function update(Request $request, Pedido $pedido){
        $this->validade($request, [
            'list' => 'required',
            'f_price' => 'required',
            'delivery_date' => 'required',
            'type' => 'required',
            'delivered' => 'required'
        ]);
        if($pedido->fill($request->all()->save()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown request']);
        }
    }

    public function myRequest(){
        if($pedidos = Pedido::where('parent_id',$this->user->id)){
            return response()->json(['status' => 'success','requests' => $pedidos]);
        }
        else{
            return response()->json(['status'=>'fail']);
        }
    }
}