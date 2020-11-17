<?php

namespace App\Http\Controllers;

use App\Client;
use App\Outstanding;
use Illuminate\Http\Request;

class OutstandingController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:outstanding-list|outstanding-create|outstanding-edit|outstanding-delete', ['only' => ['index','show']]);
         $this->middleware('permission:outstanding-create', ['only' => ['create','store']]);
         $this->middleware('permission:outstanding-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:outstanding-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $outstanding = Outstanding::when(request('search'), function($query){
            return $query->where('client','like','%'.request('search').'%')
            ->orwhere('method','like','%'.request('search').'%')
            ->orwhere('created_at','like','%'.request('search').'%');
        })
        ->orderBy('created_at','desc')->paginate(100);
        return view('outstanding.index', ['outstanding' => $outstanding]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('outstanding.create', ['clients'=>$clients]);
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

            'client' => 'required',
            'purchase_amount' => 'required',
            'payment' => 'required',
            'method' => '',
            'remark' => '',
        ]);
        $input = $request->all();
        $outstanding = Outstanding::create($input);
        return redirect()->route('outstanding.index');
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
    public function edit(Outstanding $outstanding)
    {
        $clients = Client::all();
        return view('outstanding.edit', ['clients'=>$clients], compact('outstanding'))->with('success','transactions is edited successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outstanding $outstanding)
    {
        $outstanding->client = $request->client;
        $outstanding->purchase_amount = $request->purchase_amount;
        $outstanding->payment = $request->payment;
        $outstanding->balance = $request->balance;
        $outstanding->method = $request->method;
        $outstanding->save();
        return redirect(route('outstanding.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outstanding $outstanding)
    {
        $outstanding->delete();
        return redirect(route('outstanding.index'));
    }
}
