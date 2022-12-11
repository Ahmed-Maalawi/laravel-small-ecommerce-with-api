<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVariationOptionsRequest;
use App\Models\variation;
use App\Models\variation_option;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class variation_optionsController extends Controller
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
        $variationOptions = variation_option::all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all variation',
            'data' => $variationOptions,
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
     * @param StoreVariationOptionsRequest $request
     * @return JsonResponse
     */
    public function store(StoreVariationOptionsRequest $request)
    {
        $validated = $request->validated();

        $variationOptions = variation_option::create([
            'variation_id' => $validated['variation_id'],
            'value' => $validated['value'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'variation option created successfully',
            'data' => $variationOptions,
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
        $variationOptions = variation_option::where('id', $id)->first();

        if (! $variationOptions) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'variation option not found !',
            ]));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'variation option info',
            'data' => $variationOptions,
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
     * @param StoreVariationOptionsRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StoreVariationOptionsRequest $request, $id)
    {
        $validated = $request->validated();

        $variationOptions = variation_option::where('id', $id)->first();

        if (! $variationOptions) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'variation option not found !',
            ]));
        }

        $variationOptions->update([
            'variation_id' => $validated['variation_id'],
            'value' => $validated['value'],
        ]);
        $variationOptions->save();

        return response()->json([
            'status' => 'success',
            'message' => 'variation option updated successfully',
            'data' => $variationOptions,
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
        $variationOptions = variation_option::where('id', $id)->first();

        if (! $variationOptions) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'variation option not found !',
            ]));
        }

        $variationOptions->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'variation option deleted successfully',
        ]);
    }
}
