<?php

namespace App\Http\Controllers;

use App\Models\wishlist;
use Illuminate\Http\Exceptions\HttpResponseException;

class wishListController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function storeWishList(int $id)
    {

        $item = wishlist::where(['product_id' => $id, 'user_id' => auth()->id()])->first();

        if($item) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product is already existe !',
            ]));
        }

        wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'item added successfully',
        ], 201);

    }

    public function removeWishList(int $id)
    {
        $item = wishlist::where('id', $id)->first();

        if(! $item) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found on wiwhlist !',
            ], 400));
        }

        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'item removed successfully',
        ]);
    }

    public function getWishList()
    {
        $wishListItems = wishlist::where('user_id',  auth()->id())->get();

        if(count($wishListItems) == 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'wish list is empty',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'get all wishlist items',
            'data' => $wishListItems,
        ]); 
    }
}
