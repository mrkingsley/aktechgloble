<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outstanding extends Model
{
    protected $fillable = [
        'client','purchase_amount','payment','balance','method', 'remark',

    ];
    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }
}
