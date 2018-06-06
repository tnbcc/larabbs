<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    public function index()
	{
		
		return view('student.index');
	}
	
	public function store(StudentRequest $request,Student $student){
       $student->fill($request->all());
	   $res = $student->save();
	   if($res){
		   return redirect()->route('show')->with('success','注册成功！');
	   }else{
		   return redirect()->back();
	   }
	}
	
	public function show(Student $student)
	{
		$students = $student->get();
		$map = [
		     ['sex','=',1],
			 ['age','>',10]
		];
		//$res = $student->where($map)->get()->toArray();
		$res = $student->whereRaw('sex = ? and age > ?',[1,10])->get()->toArray();
		$a = response()->json($res);
		return $a;
		exit;
		return view('student.show',compact('students'));
	}
}
