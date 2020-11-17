<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class WorkshopController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:workshop-list|workshop-create|workshop-edit|workshop-delete', ['only' => ['index','show']]);
         $this->middleware('permission:workshop-create', ['only' => ['create','store']]);
         $this->middleware('permission:workshop-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:workshop-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops = Workshop::orderBy('id','desc')->paginate(7);
        return view('workshop.index', ['workshop' => $workshops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workshop.create');
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

            'name' => 'required',
            'hardware' => '',
            'software' => '',
            'remark' => ''

        ]);
        $input = $request->all();
        $workshop = Workshop::create($input);
        return redirect()->route('workshop.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {
        return view('workshop.show', ['workshop' => $workshop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        return view('workshop.edit', compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        $workshop->name = $request->name;
        $workshop->hardware = $request->hardware;
        $workshop->software = $request->software;
        $workshop->remark = $request->remark;
        $workshop->save();
        return redirect(route('workshop.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return redirect(route('workshop.index'));
    }
}
