<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out Of Stock' : $this->stock,
            'discount' => $this->discount,
            'TotalPrice' => round((1 - ($this->discount/100))*$this->price,2), // substracting discount price from Amount 17/100 = .17, 1 - .17 = .83, .83*price
            'rating' => $this->reviews->count() > 0 ?round($this->reviews->sum('star')/$this->reviews->count(),1) : 'No Rating', // relationship name in the product model
            'href' => [
                'review' => route('review.index', $this->id),
            ]
        ];
    }
}
