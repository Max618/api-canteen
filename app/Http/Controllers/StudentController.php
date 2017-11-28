<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\Responsable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Firebase\JWT\JWT;

class StudentController extends Controller
{
	private $user;

    public function __construct(Request $request){
        //$this->middleware('cook',['except'=>['index','get']]);
        $this->user = User::find(JWT::decode($request->header('Api-Key'), env('JWT_SECRET'), ['HS256'])->sub);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'class' => 'required'
        ]);
        $parent = Responsable::find($this->user->id);
        if($parent->student()->create($request->all())){
            return response()->json(['status'=>'success']);
        }
        else{
            return response()->json(['status'=>'fail']);
        }
    }

    public function get($student){
        $student = Student::find($student);
        if($student && !empty($student)){
            return response()->json(['status'=>'success', 'student'=>$student]);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown student']);
        }
    }

    public function index(){
        $parent = Responsable::find($this->user->id);
        if($students = $parent->student()->get()){
            return response()->json(['status' =>'success','students'=>$students]);
        }
        else{
            return response()->json(['status'=> 'fail','message'=>'unkown students']);
        }
    }

    public function delete($student){
        $student = Student::find($student);
        if($student->delete()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown student']);
        }
    }

    public function update(Request $request, $student){
        $this->validate($request, [
            'name' => 'required',
            'class' => 'required'
        ]);
        $student = Student::find($student);
        if($student->fill($request->all())->save()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown student']);
        }
    }
}