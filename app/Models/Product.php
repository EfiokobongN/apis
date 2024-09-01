<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'detail', 'price', 'stock', 'discount' // Add the fields you want to be mass assignable here.
    ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
