<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreaddressRequest;
use App\Http\Requests\UpdateaddressRequest;
use App\Models\address;
use App\Models\User;
use App\Models\user_address;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $addresses = User::where('id', auth()->id())->with('user_address')->get();

        if (! $addresses) {
            return response()->json([
                'status' => 'success',
                'message' => 'not addresses found for the current user',
            ]);
        }

        return response()->json([
           'status' => 'sucess',
           'message' => 'get all addresses for current user',
           'data' => $addresses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreaddressRequest $request
     * @return JsonResponse
     */
    public function store(StoreaddressRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $address = address::create([
            'address_type' => $validated['address_type'],
            'phone_number' => $validated['phone_number'],
            'address_description' => $validated['address_description'],
        ]);

        user_address::create([
            'user_id' => auth()->id(),
            'address_id' => $address['id'],
        ]);

        return response()->json([
            'status'=> 'success',
            'message' => 'address added successfully',
            'data' => $address,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
//     * @param  \App\Models\address  $address
//     * @return \Illuminate\Http\Response
     */
//    public function show(address $address)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  \App\Models\address  $address
//     * @return \Illuminate\Http\Response
     */
//    public function edit(address $address)
//    {
//
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateaddressRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateaddressRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $address = address::where('id', $id)->first();


        if (! $address) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'address not found',
            ], 400));
        }
//        return response()->json($address);
        $address->update([
            'address_type' => $validated['address_type'],
            'phone_number' => $validated['phone_number'],
            'address_description' => $validated['address_description'],
        ]);

        $address->save();

        return response()->json([
            'status' => 'success',
            'message' => 'address updated successfully',
            'data' => $address,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {

        $address = address::where('id', $id)->first();

        if (! $address) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'address not found',
            ], 400));
        }

        $address->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'address deleted successfully'
        ]);
    }
}
