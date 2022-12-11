<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\product;
//use HttpResponse;
use App\Models\product_configuration;
use App\Models\product_item;
use App\Models\variation_option;
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
//     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth:admin-api');
//    }

    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = product::with('productItems')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'return all products',
            'data' => [
                'products' => $products,
            ]
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
//     * @param ProductStoreRequest $request
//     * @return JsonResponse
     */
    public function store()
    {

        $request_2 = [
            'product' => [
                'category_id' => 3,
                'name' => 'nike شورت',
                'description' => 'nike شورت',
                'product_image' => 'nike شورت',
            ],
            'product_items' => [
                [
                    'sku' => 'lkf4fg574d32fg854dfgh354',
                    'qty_in_stock' => 100,
                    'product_image' => 'public/uploads/products/02227d8f-7903-4957-9ae7-0ffb8a3737a3.avif',
                    'price' => 50,
                    'variation' => [1,4],
                ],
                [
                    'sku' => 'lkf4fg574d32fg854dfgh354',
                    'qty_in_stock' => 150,
                    'product_image' => 'public/uploads/products/02227d8f-7903-4957-9ae7-0ffb8a3737a3.avif',
                    'price' => 100,
                    'variation' => [2,4]
                ],
            ]
        ];


        $newProduct = $request_2['product'];
        $product = product::create([
            'category_id' => $newProduct['category_id'],
            'name' => $newProduct['category_id'],
            'description' => $newProduct['description'],
            'product_image' => $newProduct['product_image'],
        ]);

//        return response()->json([
//            'data' => $product
//        ]);

        foreach ($request_2['product_items'] as $productItem) {
            $newItem = product_item::create([
                'product_id' => $product->id,
                'sku' => $productItem['sku'],
                'qty_in_stock' => $productItem['qty_in_stock'],
                'product_image' => $productItem['product_image'],
                'price' => $productItem['price'],
            ]);

            foreach ($productItem['variation'] as $variation) {
                product_configuration::create([
                    'product_item_id' => $newItem->id,
                    'variation_option_id' => $variation,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'product added successfully',
            'data' => [
                'product' => $product->with('productItems')->get(),
            ]
        ], 201);
//        }
//        try {
//            $validated = $request->validated();
//
//            $image = $request->file('image');
//            $name_gen = time().'.'. $image->getClientOriginalExtension();
//            Image::make($image)->save('uploads/products/' . $name_gen);
//            $save_url = 'uploads/products/' . $name_gen;
//
//            $product = product::create([
//                'name' => $validated['name'],
//                'description' => $validated['description'],
//                'product_image' => $save_url,
//                'category_id' => $validated['category_id'],
//            ]);
//
//            $product_item = product_item::create([
//               'product_id' => $product['id'],
//                '' => '',
//            ]);
//
//            return response()->json([
//                'status' => 'success',
//                'message' => 'product added successfully',
//                'data' => $product,
//            ]);
//
//        } catch (HttpResponseException $e) {
//
//            throw new $e(response()->json([
//                'status' => 'error',
//                'message' => 'product store error',
//            ], 400));
//
//        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $product = product::with('productItems')->get();

        return response()->json($product);
    }

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

    private function uploadImg(string $path, $image): string
    {
        try {
            $name_gen = time().'.'. $image->getClientOriginalExtension();
            Image::make($image)->save($path . $name_gen);
            $save_url = $path . $name_gen;

            return $save_url;
        } catch (HttpResponseException $e) {
            throw new $e(response()->json([
                'status' => 'error',
                'message' => 'image store error',
            ]));
        }
    }
}
