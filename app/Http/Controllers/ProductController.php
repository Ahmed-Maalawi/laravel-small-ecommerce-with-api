<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\product;
//use HttpResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }

    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param ProductStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            $image = $request->file('image');
            $name_gen = time().'.'. $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/products/' . $name_gen);
            $save_url = 'uploads/products/' . $name_gen;

            $product = product::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'product_image' => $save_url,
                'category_id' => $validated['category_id'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'product added successfully',
                'data' => $product,
            ]);

        } catch (HttpResponseException $e) {

            throw new $e(response()->json([
                'status' => 'error',
                'message' => 'product store error',
            ], 400));

        }
    }

    /**
     * Display the specified resource.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\JsonResponse
     */
//    public function editImage($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validated();

        $product = product::find($id);

        if (! $product) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found !',
            ]));
        }

        $product::update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
        ]);

        if($validated->hasfile('image')) {
            if ($oldImage = $product['product_image'])
                unlink($oldImage);

            $image = $validated->file('image');
            $name_gen = time().'.'. $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/products/' . $name_gen);
            $save_url = 'uploads/products/' . $name_gen;

            $product::update([
                'product_image' => $save_url,
            ]);
        }

        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'product updated successfully',
            'data' => [
                'product' => $product,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = product::find($id);

        if (! $product) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found !',
            ]));
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'product deleted successfully',
        ]);
    }

    public function clearProductImage(int $id)
    {

        $product = product::find($id);
        if(! $product) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found !',
            ]));
        }

        if( isEmpty($product['product_image']) ) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'image already empty',
            ]));
        }

        unlink($product['product_image']);

        return response()->json([
            'status' => 'success',
            'message' => 'product Image clear successfully',
        ]);
    }
}
