<?php 

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Cook;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Firebase\JWT\JWT;
 
class ProductController extends Controller
{
    private $user;

    public function __construct(Request $request){
        $this->middleware('cook',['except'=>['index','get']]);
        $this->user = User::find(JWT::decode($request->header('Api-Key'), env('JWT_SECRET'), ['HS256'])->sub);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);
        $cook = Cook::find($this->user->id);
        if($cook->product()->create($request->all())){
            return response()->json(['status'=>'success']);
        }
        else{
            return response()->json(['status'=>'fail']);
        }
    }

    public function get($product){
        $product = Product::find($product);
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

    public function delete($product){
        $product = Product::find($product);
        if($product->delete()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown product']);
        }
    }

    public function update(Request $request, $product){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'type' => 'required',
            'amount' => 'required'
        ]);
        $product = Product::find($product);
        if($product->fill($request->all())->save()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown product']);
        }
    }
}