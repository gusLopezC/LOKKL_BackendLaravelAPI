<?php

namespace App;
use App\Buyer;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'name',
        'buyer_id',
        'product_id'
    ];


    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
