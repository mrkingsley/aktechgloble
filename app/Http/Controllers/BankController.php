<?php

namespace App\Http\Controllers;
use App\Bank;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class BankController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:bank-list|bank-create|bank-edit|bank-delete', ['only' => ['index','show']]);
         $this->middleware('permission:bank-create', ['only' => ['create','store']]);
         $this->middleware('permission:bank-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bank-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::when(request('search'), function($query){
            return $query->where('name','like','%'.request('search').'%')
            ->orwhere('transaction','like','%'.request('search').'%')
            ->orwhere('machine','like','%'.request('search').'%')
            ->orwhere('created_at','like','%'.request('search').'%');
        })
        ->orderBy('created_at','desc')->paginate(100);
        return view('bank.index', ['bank' => $banks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bank.create');
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

            'name' => '',
            'transaction' => 'required',
            'amount' => 'required',
            'account_name' => '',
            'account_no' => '',
            'bank_charge' => 'required',
            'charge' => 'required',
            'machine' => 'required',


        ]);
        $input = $request->all();
        $bank = Bank::create($input);
        return redirect()->route('bank.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return view('bank.show', ['client' => $bank]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view('bank.edit', compact('bank'))->with('success','transactions is edited successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $bank->name = $request->name;
        $bank->phone = $request->phone;
        $bank->transaction = $request->transaction;
        $bank->amount = $request->amount;
        $bank->account_name = $request->account_name;
        $bank->account_no = $request->account_no;
        $bank->bank_charge = $request->bank_charge;
        $bank->charge = $request->charge;
        $bank->machine = $request->machine;
        $bank->remark = $request->remark;
        $bank->save();
        return redirect(route('bank.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect(route('bank.index'));
    }
}
