<?php

namespace App\Http\Controllers;

use App\Expense;
Use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{ 
    
    function __construct()
    {
         $this->middleware('permission:expense-list|expense-create|expense-edit|expense-delete', ['only' => ['index','show']]);
         $this->middleware('permission:expense-create', ['only' => ['create','store']]);
         $this->middleware('permission:expense-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $data['expenses'] = Expense::where('user_id', Auth::user()->id)->latest()->paginate(12);

        return view('expenses.index', $data);
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_title' => 'required',
            'expense_amount' => 'required',
            'expense_date'=> 'required'
        ]);

        $expense = new Expense();
        $expense->expense_title = $request->expense_title;
        $expense->expense_amount = $request->expense_amount;
        $expense->expense_date = $request->expense_date;
        $expense->user_id = Auth::user()->id;
        $expense->save();

        return redirect('/expense')->with('message', 'New Expense Added');
    }

    public function edit($id)
    {
        $data['expense'] = Expense::findOrFail($id);
        return view('.expenses.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'expense_title' => 'required',
            'expense_amount' => 'required',
            'expense_date'=> 'required'
        ]);

        $expense = Expense::findOrFail($request->expense_id);
        $expense->expense_title = $request->expense_title;
        $expense->expense_amount = $request->expense_amount;
        $expense->expense_date = $request->expense_date;
        $expense->update();

        return redirect('/expense')->with('message', 'Expense details updated successfully');
    }

    public function destroy($id)
    {
        Expense::findOrFail($id)->delete();
        return back()->with('message', 'Expense details deleted successfully');
    }

    public function summary()
    {
        $incomes = Income::where('user_id', Auth::User()->id)->get()->toArray();
        $expenses = Expense::where('user_id', Auth::User()->id)->get()->toArray();
        foreach ($incomes as $key => $value) {
            $incomes[$key]['type'] = 'income';
        }

        foreach ($expenses as $key => $value) {
            $expenses[$key]['type'] = 'expense';
        }

        $data['results'] = array_merge($incomes, $expenses);
        $data['total_income'] = Income::where('user_id', Auth::User()->id)->sum('income_amount');
        $data['total_expense'] = Expense::where('user_id', Auth::User()->id)->sum('expense_amount');
        $data['balance'] = $data['total_income'] - $data['total_expense'];

        return view('expenses.summary', $data);
    }
}
