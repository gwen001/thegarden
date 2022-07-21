<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/products",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get list of products",
     *      description="Get list of products",
     *      @OA\Parameter(
     *          name="q",
     *          description="query (term to search in title and short_descr)",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      ),
     * )
     */
    public function index(Request $request)
    {
        $q = $request->query('q',null);

        $query = 'SELECT * FROM products';
        if( !is_null($q) ) {
            $query .= " WHERE title LIKE '%".$q."%' OR short_descr LIKE '%".$q."%'";
        }
        $query .= ' ORDER BY id DESC';
        // var_dump($query);

        $t_datas = DB::select($query);

        $t_products = [];
        foreach( $t_datas as $d ) {
            // var_dump($d);
            $o = (new Product())->fill((array)$d);
            $o->id = $d->id;
            // var_dump($o);
            $t_products[] = $o;
        }

        return ProductResource::collection($t_products);


        if( is_null($q) ) {
            $t_products = Product::orderBy('id','DESC')->get();
        } else {
            $q = '%'.$q.'%';
            $t_products = Product::where(function ($query) use ($q) {
                $query->where('title', 'like', $q)
                    ->orWhere('short_descr', 'like', $q);
            })->orderBy('id','DESC')->get();
        }

        return ProductResource::collection($t_products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/products/{id}",
     *      operationId="getProduct",
     *      tags={"Products"},
     *      summary="Get a single product",
     *      description="Get a single product",
     *      @OA\Parameter(
     *          name="id",
     *          description="product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      ),
     * )
     */
    public function show(Product $product)
    {
        if( !$product ) {
            return abort(404);
        }

        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
