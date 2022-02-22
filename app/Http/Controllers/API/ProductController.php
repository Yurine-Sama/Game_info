<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return Products::all();
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
        $request->validate([
            'product_image' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required'

        ]);
        $product = Products::create($request->all());

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Products::find($id);
        return $product;
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
        $id = $request->id;

        $product = Products::find($id);
        //dd($product);
        $product->product_name = $request->product_name;
        $product->product_image = $request->product_image;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'update success',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);

        $product->delete();
        return response()->json([
            'success' => true,
            'message' => 'delete done'
        ]);
    }

    public function search($name)
    {
        $products = Products::where([
            ['product_name', 'like', '%' . $name . '%']
        ])->get();
        return $products;
    }

    // public function search(Request $request)
    // {
    //     if ($request->has('search')) {
    //         $game = Products::where('product_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
    //     } else {
    //         $game = Products::paginate(5);
    //     }
    //     return view('home', compact('$game'));
    // }   
}
