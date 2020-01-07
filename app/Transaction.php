<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function transaction_others_fee() 
    {
        return $this->hasMany(TransactionOtherFee::class, 'or_number', 'or_number');
    }
}
