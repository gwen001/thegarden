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
        // var_dump($request->get('id'));

        // OK
        // $p = Product::Find($request->get('id'));

        // OK
        // $p = Product::where('id',$request->input('id'))->get();
        // $p = DB::table('users')->where('id', $_GET['id'])->get();
        // NOT OK
        // $p = Product::whereRaw('id='.$request->input('id'))->get();
        // $p = DB::table('products')->whereRaw("id=".$_GET['id'])->get();
        // $p = DB::table('products')->whereRaw("id='".$_GET['id']."'")->get();

        // OK
        // $p = DB::select('SELECT * FROM products WHERE id = ?', [$request->input('id')]);
        // $p = DB::select('SELECT * FROM products WHERE id = :id', ['id'=>$request->input('id')]);
        // NOT OK
        // $p = DB::select('SELECT * FROM products WHERE id = '.$request->input('id'));

        // OK
        // $p = DB::statement('SELECT * FROM products WHERE id = ?', [$request->input('id')]);
        // NOT OK
        // $p = DB::statement('SELECT * FROM products WHERE id = '.$request->input('id'));


        // $p = DB::table('products')->select(DB::raw('count(*) as '.$_GET['c']))->where('id',$_GET['id'])->get();
        // $p = DB::table('products')->selectRaw($_GET['c'])->get();
        // $p = DB::table('products')->where('id',$_GET['id'])->havingRaw($_GET['c'].' > 0')->get();
        // $p = DB::table('products')->where('id',$_GET['id'])->orderByRaw($_GET['c'])->get();
        // $p = DB::table('products')->where('id',$_GET['id'])->groupByRaw($_GET['c'])->get();


        // ???
        // $p = DB::raw("SELECT * FROM products WHERE id = ".$_GET['id']);
        // $p = DB::table('products')->select( DB::raw('SELECT * FROM products WHERE id = '.$request->input('id')) );
        // $p = DB::table('products')->select( DB::raw('SELECT * FROM products WHERE id = '.$request->input('id')) );


        // SOSO
        // $p = Product::where($request->input('colname'), 'somedata')->get();
        // $p = Product::query()->orderBy($request->input('sortBy'))->get();




        // var_dump($p);

        // exit();



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


        // if( is_null($q) ) {
        //     $t_products = Product::orderBy('id','DESC')->get();
        // } else {
        //     $q = '%'.$q.'%';
        //     $t_products = Product::where(function ($query) use ($q) {
        //         $query->where('title', 'like', $q)
        //             ->orWhere('short_descr', 'like', $q);
        //     })->orderBy('id','DESC')->get();
        // }

        // return ProductResource::collection($t_products);
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
