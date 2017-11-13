<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Users;
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
            'class' => 'required'
        ]);
        if($this->user->parent()->student()->Create($request->all())){
            return response()->json(['status'=>'success']);
        }
        else{
            return response()->json(['status'=>'fail']);
        }
    }

    public function get(Student $student){
        if($student && !empty($student)){
            return response()->json(['status'=>'success', 'student'=>$student]);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown student']);
        }
    }

    public function index(){
        if($students = Student::where('parent_id', $this->user->id)){
            return response()->json(['status' =>'success','students'=>$students]);
        }
        else{
            return response()->json(['status'=> 'fail','message'=>'unkown students']);
        }
    }

    public function delete(Student $student){
        if($student->delete()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown student']);
        }
    }

    public function update(Request $request, Student $student){
        $this->validade($request, [
            'name' => 'required',
            'class' => 'required'
        ]);
        if($student->fill($request->all()->save()){
            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status'=>'fail','message'=>'unkown student']);
        }
    }
}