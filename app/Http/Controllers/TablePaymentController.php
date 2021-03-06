<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;

use App\tblpayments;
use App\tblscholars;
class TablePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function summary($id)
    {
          // $students = tblscholars::all();
   $students= DB::table('tblscholars as t1')
        
        ->join("tblpayments as t2", "t2.payid","=","t1.id")  
        
        ->where('t1.id', '=', $id)
        ->select("t2.month","t2.year","t2.amount","t2.dateofpayment","t2.payid","t1.last_name","t1.first_name","t1.middle_name")
        ->get()
        ->toArray();
        $TOTAL = DB::table('tblpayments')
        ->join('tblscholars', 'tblpayments.payid', '=', 'tblscholars.id')
        ->where('tblscholars.id', '=', $id)
        ->sum('tblpayments.amount');
        if($TOTAL == 12000){
            Session::flash('status', 'Fully Paid!');
            return view('home'); 
        }
        else if($TOTAL > 12000){
            Session::flash('status', 'Excess Payment, Please contact your admin!');
            return view('home'); 
        }
         

        
        if($students!=[]){
            return view('student.summary',compact('students','TOTAL'));
           
        }else{
            $student = tblscholars::find($id);
            return view('student.pay',compact('student'));
        }


            
          
            
    }

    public function stores(Request $request,$id)
    {
        $this->validate($request,[
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required',
            'dateofpayment'=> 'required',
        ]);
        $student = new tblpayments([
            'payid' => $id,
            'month' => $request->get('month'),
            'year' => $request->get('year'),
            'amount' => $request->get('amount'),
            'dateofpayment' => $request->get('dateofpayment'), 
        ]);
        $student->save();
        return redirect('/list');
    }

 
    public function pay($id){
        $student = tblscholars::find($id);
        return view('student.pay',compact('student'));
    }
    public function summarybatch($batch){
        
        $students =tblscholars::where('batch',$batch)->get();
        $student = DB::table('tblpayments')
        ->join('tblscholars', 'tblpayments.payid', '=', 'tblscholars.id')
        ->where('tblscholars.batch', '=', $batch)
        ->sum('tblpayments.amount');
        



        // return redirect()->back()->with('alert', 'The total amount is '.$students.' pesos');
        return view('student.summaryBatch',compact('students','student'));
    }
    public function total($id)
    {
          // $students = tblscholars::all();
                    
    }
    function summaryYear($batch ){
        // $myMonth = $request->get('year');
        $students = DB::table('tblpayments')
        ->join('tblscholars', 'tblpayments.payid', '=', 'tblscholars.id')
        ->where('tblscholars.batch', '=', $batch)
        ->sum('tblpayments.amount');
        return redirect()->back()->with('alert', 'The total amount is '.$students.' pesos');
    }
    function summaryMonth($month ){
        // $myMonth = $request->get('year');
        $students = DB::table('tblpayments')
        ->join('tblscholars', 'tblpayments.payid', '=', 'tblscholars.id')
        ->where('tblpayments.month', '=', $month)
        ->sum('tblpayments.amount');
        return redirect()->back()->with('alert', 'The total amount is '.$students.' pesos');
        // dd($students);
    }
    function displayByMonth($month){
        $students =tblpayments::where('month',$month)->get();
        // return redirect()->back()->with('alert', 'The total amount is '.$students.' pesos');
        return view('student.summaryMonth',compact('students'));
    }
    function summaryDate(Request $request){
        $date=strtotime($request->get('date'));
        $dates=date('Y-m-d',$date);
        $student = DB::table('tblpayments')
        ->join('tblscholars', 'tblpayments.payid', '=', 'tblscholars.id')
        ->select('tblpayments.dateofpayment')
        ->where('tblpayments.dateofpayment', '=', $dates)
        ->sum('tblpayments.amount');
        return redirect()->back()->with('alert', 'The total amount is '.$students.' pesos');
    }
    function displayByDate(Request $request){
        $date=strtotime($request->get('date'));
        $dates=date('Y-m-d',$date);
        $students =tblpayments::where('dateofpayment',$dates)->get();
        return view('student.summaryDate',compact('students'));
    }


    public function mgaSummary(Request $request){
        $students = Tblscholars::with('payment')->orderBy('batch','DESC')->get();
        $payments = Tblpayments::all();

        $month = "";
        $datas=[];
        foreach($payments as $payment){
           
          if(($payment->month)==$month){
                $month=$payment->month;
            }else{
                $month=$payment->month;
                array_push($datas,$payment->month);
            }   
             }
        //    return view('student.welcome',compact('students','datas'));
        dd($datas);
      
    }
        public function summaries(){
        
         return view('student.summaries');
        }
      
}