<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:incomes-list|incomes-create|incomes-edit|incomes-delete', ['only' => ['index','show']]);
         $this->middleware('permission:incomes-create', ['only' => ['create','store']]);
         $this->middleware('permission:incomes-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:incomes-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['incomes'] = Income::when(request('search'), function($query){
            return $query->where('income_title','like','%'.request('search').'%')
            ->orwhere('income_date','like','%'.request('search').'%')
            ->orwhere('created_at','like','%'.request('search').'%');
        })
        ->orderBy('created_at','desc')->paginate(100);

        return view('incomes.index', $data);
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'income_title' => 'required',
            'income_amount' => 'required',
            'income_date'=> 'required'
        ]);

        $incomes = new Income();
        $incomes->income_title = $request->income_title;
        $incomes->income_amount = $request->income_amount;
        $incomes->income_date = $request->income_date;
        $incomes->user_id = Auth::user()->id;
        $incomes->save();

        return redirect('/incomes')->with('message', 'New Income Added');
    }

    public function edit($id)
    {
        $data['income'] = Income::findOrFail($id);
        return view('incomes.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'income_title' => 'required',
            'income_amount' => 'required',
            'income_date'=> 'required'
        ]);

        $income = Income::findOrFail($request->income_id);
        $income->income_title = $request->income_title;
        $income->income_amount = $request->income_amount;
        $income->income_date = $request->income_date;
        $income->update();

        return redirect('/incomes')->with('message', 'Income details updated successfully');
    }

    public function destroy($id)
    {
        Income::findOrFail($id)->delete();
        return back()->with('message', 'Income details deleted successfully');
    }
}
