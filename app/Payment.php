<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'supplier','purchase_amount','payment','balance','method', 'remark',

    ];
    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'suppliers_id');
    }
}
