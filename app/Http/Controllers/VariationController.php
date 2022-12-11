<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVariatoinRequest;
use App\Models\variation;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VariationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $variation = variation::all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all variation',
            'data' => $variation,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVariatoinRequest $request
     * @return JsonResponse
     */
    public function store(StoreVariatoinRequest $request)
    {
        $validated = $request->validated();

        $variation = variation::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['variation_name'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'variation created successfully',
            'data' => $variation,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $variation = variation::where('id', $id)->first();

        if (! $variation) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'variation not found !',
            ]));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'variation info',
            'data' => $variation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreVariatoinRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StoreVariatoinRequest $request, $id)
    {
        $validated = $request->validated();

        $variation = variation::where('id', $id)->first();

        if (! $variation) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'variation not found !',
            ]));
        }

        $variation->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['variation_name'],
        ]);
        $variation->save();

        return response()->json([
            'status' => 'success',
            'message' => 'variation updated successfully',
            'data' => $variation,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $variation = variation::where('id', $id)->first();

        if (! $variation) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'variation not found !',
            ]));
        }

        $variation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'variation deleted successfully',
        ]);
    }
}
