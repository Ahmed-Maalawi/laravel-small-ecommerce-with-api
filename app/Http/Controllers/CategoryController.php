<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\throwException;
use App\Http\Requests\CategoryStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin-api', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {

        $categories = category::all();
//        $categories = category::with(['sub_category','variation'])->whereNull('parent_category_id')->get();
//
        return response()->json([
            'status' => 'success',
            'message' => 'get all categories',
            'data' => $categories,
        ]);
    }


    /**
     * Show the form for creating a new resource.
//     * @param int $id
//     * @return JsonResponse
     */
//    public function getOneCategory(int $id): JsonResponse
//    {
//        $category = category::where('id', $id)->with('variation')->get();
//
//        if ( isEmpty($category)) {
//            throw new HttpResponseException(response()->json([
//                'status' => 'error',
//                'message' => 'category not found',
//            ]));
//        }
//
//        return response()->json([
//            'status' => 'success',
//            'message' => 'get category info',
//            'data' => $category,
//        ]);
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return JsonResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            $category = category::create([
                'category_name' => $validated['category_name'],
                'parent_category_id' => ($validated['parent_category_id'])?? null,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'category created successfully',
                'data' => $category,
            ], 201);

        } catch (HttpResponseException $e) {
            throw new $e(response()->json([
                'status' => 'error',
                'message' => 'category store error',
            ]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $category = category::find( $id)->first()->get();

        if ( isEmpty($category)) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'category not found',
            ]));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'get category info',
            'data' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(CategoryStoreRequest $request, int $id)
    {
        $validated = $request->validated();

        $category = category::find($id);

        if (! $category) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'category not found !',
            ], 400));
        }
//        return $request['category_name'];

        $category->update([
            'category_name' => $request['category_name'],
            'parent_category_id' => ($request['parent_category_id'])?? null,
        ]);

        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'category updated successfully',
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
        $category = category::withCount('sub_category')->find($id);

        if (! $category) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'category not found !',
            ], 400));
        }

//        return response()->json($category);

        if ($category['sub_category_count'] > 0) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'category have subCategories !',
            ], 400));
        }
        try {
//            $category->update([
//                'parent_category_id' => null,
//            ]);
//            $category->save();
            $category->delete();
        } catch (HttpResponseException $e) {
            throw new $e(response()->json([
                'status' => 'error',
                'message' => 'some thing went wrong !',
            ], 400));
        }

//        if (count($category->children)) {
//            foreach ($category->children as $sub_category) {
//                $subCategory = category::find($sub_category['id'])->delete();
//            }
//        }
//        $category->sub_category->delete();


        return response()->json([
            'status' => 'success',
            'message' => 'category deleted successfully',
        ]);
    }
}
