<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Supplier;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:payment-list|payment-create|payment-edit|payment-delete', ['only' => ['index','show']]);
         $this->middleware('permission:payment-create', ['only' => ['create','store']]);
         $this->middleware('permission:payment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payment-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $payments = Payment::when(request('search'), function($query){
            return $query->where('supplier','like','%'.request('search').'%')
            ->orwhere('method','like','%'.request('search').'%')
            ->orwhere('created_at','like','%'.request('search').'%');
        })
        ->orderBy('created_at','desc')->paginate(100);
        return view('payment.index', ['payment' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('payment.create', ['suppliers'=>$suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'supplier' => 'required',
            'purchase_amount' => 'required',
            'payment' => 'required',
            'method' => 'required',
            'remark' => '',
        ]);
        $input = $request->all();
        $payment = Payment::create($input);
        return redirect()->route('payment.index');
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
    public function edit(Payment $payment)
    {
        $suppliers = Supplier::all();
        return view('payment.edit', ['suppliers'=>$suppliers], compact('payment'))->with('success','transactions is edited successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->supplier = $request->supplier;
        $payment->purchase_amount = $request->purchase_amount;
        $payment->payment = $request->payment;
        $payment->balance = $request->balance;
        $payment->method = $request->method;
        $payment->save();
        return redirect(route('payment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect(route('payment.index'));
    }
}
