<?php 

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Product;
use Auth;
 
class ProductController extends Controller
{
    private $user;

    public function __contruct(){
        //$this->middleware('auth',['only' => 'index']);
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

    public function get(Product $product){
        if($product && !empty($product)){
            return response()->json(['status'=>'success', 'product'=>$product]);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown product']);
        }
    }

    public function index(){
        if($products = Product::all()){
            return response()->json(['status' =>'success','products'=>$products]);
        }
        else{
            return response()->json(['status'=> 'fail','message'=>'unkown products']);
        }
    }

    public function delete(Product $product){
        if($product->delete()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown product']);
        }
    }

    public function update(Request $request, Product $product){
        $this->validade($request, [
            'name' => 'required',
            'price' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);
        if($product->fill($request->all()->save())){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown product']);
        }
    }
}