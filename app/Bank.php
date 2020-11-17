<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name' ,'transaction','amount','machine','account_name','account_no', 'phone','bank_charge','charge','remark',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
