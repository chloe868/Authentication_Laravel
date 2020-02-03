<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tblscholars;
use App\tblpayments;
use Illuminate\Support\Facades\DB;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     //Store the inputed data in the db
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'batch' => 'required',
            'contact_number'=> 'required|digits:11',
            'email' => 'required','unique',
        ]);
        $student = new tblscholars([
            'first_name' => $request->get('first_name'),
            'middle_name' => $request->get('middle_name'),
            'last_name' => $request->get('last_name'),
            'batch' => $request->get('batch'),
            'contact_number' => $request->get('contact_number'),
            'email' => $request->get('email'), 
        ]);
        $student->save();
        // $ID=$student->id;
        // $students = new tblpayments([
        //     'month' => '0',
        //     'payid' => $ID,
        //     'year' => 0,
        //     'amount' => 0,
        //     'dateofpayment' => date('Y-m-d H:i:s'),   
        // ]);
        // $students->save();     
        // return redirect()->route('welcome');
        return redirect('/home')->with('success', 'Task Created Successfully!');

        // return redirect()->routes('student.create')->with('success','Data Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $student = tblscholars::find($id);
        if(!$student){
            return abort(404);
        }
        // DB::table('students')->where('id',$id)->update();
        return view('student.edit',compact('student'));
        // return view('student.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     //welcome Home page
    
    public function welcome(Request $request){
        $students = Tblscholars::with('payment')->orderBy('batch','DESC')->get();
            return view('student.welcome',compact('students'));   
      
    }
    
}