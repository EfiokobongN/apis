<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Product;use Illuminate\Http\Response;


class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except('index', 'show', 'store', 'create', 'update', 'destroy');

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        //
        return ReviewResource::collection($product->reviews); //Getting a Review of a single product
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, Product $product)
    {
        //
        $review = new Review;
        $review->customer = $request->customer;
        $review->product_id = $product->id;
        $review->star = $request->Rate;
        $review->review = $request->Message;
        $review->save();

        return response([
            'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Product $product, Review $review)
    {
        //
        $review->update($request->all());

        return response([
            'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Review $review)
    {
        //
        $review->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
