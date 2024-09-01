<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

trait ExceptionTrait

{
    public function apiException($request, $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Product Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Incorrect Route',
            ], Response::HTTP_NOT_FOUND);
        }
    }
}