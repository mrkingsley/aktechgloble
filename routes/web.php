<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('/products','ProductController');

    //pdf
    Route::get('generate-pdf','PDFController@generatePDF');

    //excel
    Route::get('importExportView', 'ExcelController@importExportView');
    Route::get('export', 'ExcelController@export')->name('export');
    Route::post('import', 'ExcelController@import')->name('import');

    //change password
    Route::get('change-password', 'ChangePasswordController@index');
    Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

    Route::get('/transcation', 'TransactionController@index');
    Route::post('/transcation/addproduct/{id}', 'TransactionController@addProductCart');
    Route::post('/transcation/removeproduct/{id}', 'TransactionController@removeProductCart');
    Route::post('/transcation/clear', 'TransactionController@clear');
    Route::post('/transcation/increasecart/{id}', 'TransactionController@increasecart');
    Route::post('/transcation/decreasecart/{id}', 'TransactionController@decreasecart');
    Route::post('/transcation/bayar','TransactionController@bayar');
    Route::get('/transcation/history','TransactionController@history');
    Route::get('/transcation/laporan/{id}','TransactionController@laporan');
     //User

    // Workshop
    Route::resource('workshop','WorkshopController');


    // Bank
    Route::resource('bank','BankController');

    // Purchases
    Route::resource('purchase','PurchaseController');

    // Payments
    Route::resource('payment','PaymentController');

    // Outstanding
    Route::resource('outstanding','OutstandingController');

    // Client
    Route::resource('client','ClientController');

    // Supplier
    Route::resource('supplier','SupplierController');

     // Transactions
    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::resource('transactions', 'TransactionsController');

    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');


    //pdf generate new
    Route::get('/laporan/mypdf','TransactionController@createPDF');


    //Income Route
    Route::get('/incomes', 'IncomeController@index')->name('incomes.index');
    Route::get('/incomes/create', 'IncomeController@create')->name('incomes.create');
    Route::post('/incomes/store', 'IncomeController@store')->name('incomes.store');
    Route::get('/incomes/edit/{id}', 'IncomeController@edit')->name('incomes.edit');
    Route::post('/incomes/update', 'IncomeController@update')->name('incomes.update');
    Route::get('/incomes/delete/{id}', 'IncomeController@destroy')->name('incomes.delete');

    //Expense Route
    Route::get('/expense', 'ExpenseController@index')->name('expense.index');
    Route::get('/expense/create', 'ExpenseController@create')->name('expense.create');
    Route::post('/expense/store', 'ExpenseController@store')->name('expense.store');
    Route::get('/expense/edit/{id}', 'ExpenseController@edit')->name('expenses.edit');
    Route::post('/expense/update', 'ExpenseController@update')->name('expenses.update');
    Route::get('/expense/delete/{id}', 'ExpenseController@destroy')->name('expenses.delete');

    // Expense/Income summaries
    Route::get('expense/summaries', 'ExpenseController@summary')->name('expenses.summary');
});





// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
