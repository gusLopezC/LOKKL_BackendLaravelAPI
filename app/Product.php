<?php

namespace App;
use App\Category;
use App\Seller;
use App\Transaction;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const PRODUCTO_DISPONIBLE= true;

    protected $fillable = [
        'name',
        'description',
        'location',
        'cost',
        'calification',
        'status',
        'image',
        'seller_id'

    ];

    public function estaDisponible(){
        return $this->status == Product::PRODUCTO_DISPONIBLE;

    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

    public function  categories(){
        return $this->belongsToMany(Category::class);
    }
}
