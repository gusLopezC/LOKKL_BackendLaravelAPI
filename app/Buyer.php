<?php

namespace App;
use App\Transaction;

class Buyer extends User
{
    //
    public function transcations(){
        
        return $this->hasMany(Transaction::class);
    }
}
