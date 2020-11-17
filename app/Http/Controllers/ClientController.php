<?php

namespace App\Http\Controllers;


use App\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class ClientController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:client-list|client-create|client-edit|client-delete', ['only' => ['index','show']]);
         $this->middleware('permission:client-create', ['only' => ['create','store']]);
         $this->middleware('permission:client-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:client-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::when(request('search'), function($query){
            return $query->where('name','like','%'.request('search').'%')
            ->orwhere('created_at','like','%'.request('search').'%');
        })
        ->orderBy('created_at','desc')->paginate(100);
        return view('client.index', ['client' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
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

            'customer_name' => 'required',
            'phone' => 'required',

        ]);
        $input = $request->all();
        $client = Client::create($input);
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit', compact('client'))->with('success','customer edited successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->customer_name = $request->customer_name;
        $client->remark = $request->remark;
        $client->phone = $request->phone;
        $client->save();
        return redirect(route('client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect(route('client.index'));
    }
}
