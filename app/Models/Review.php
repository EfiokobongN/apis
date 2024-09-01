<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'star', 'review', 'customer', 'product_id' // Add the fields you want to be mass assignable here.
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
