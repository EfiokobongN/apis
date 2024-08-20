<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        /*return [
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out Of Stock' : $this->stock,
            'discount' => $this->discount,
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),1) : 'No Rating', // relationship name in the product model
           /* 'href' => [
                'link' => route('products.show', $this->id),
            ]*
        ];*/ // not working for laravel 10 but 5

        return $this->collection->map(function ($product) {
            return [
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->stock == 0 ? 'Out Of Stock' : $product->stock,
                'discount' => $product->discount,
                'rating' => $product->reviews->count() > 0
                    ? round($product->reviews->sum('star') / $product->reviews->count(), 1)
                    : 'No Rating',

                'href' => [
                    'ProductDetails' => route('products.show', $product->id),
                    ],
            ];
        })->all(); //Workin for Laravel 10
    }
}
