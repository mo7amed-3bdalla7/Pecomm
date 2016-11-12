<?php

namespace App\Http\Controllers;

use app\Category;
use App\Product;
use \Illuminate\Support\Facades\Input;

class StoreController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('csrf', array('on' => 'post'));
        $this->middleware('auth', array('only' => array('postAddtocart', 'getCart', 'getRemoveitem')));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('store.index')
            ->with('products', Product::take(4)->orderBy('created_at', 'DESC')->get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((int)$id)
            return view('store.view')->with('product', Product::find($id));
        return \Redirect::to('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    public function getCategory($cat_id)
    {
        return view('store.category')
            ->with('products', Product::where('category_id', '=', $cat_id)->paginate(6))
            ->with('category', Category::find($cat_id));
    }


    public function getSearch()
    {

        $keyword = \Illuminate\Support\Facades\Input::get('keyword');
        return view('store.search')
            ->with('products', Product::where('title', 'Like', $keyword . '%')->get())
            ->with('keyword', $keyword);
    }


    public function postAddtocart()
    {
        $product = Product::find(Input::get('id'));
        $quantity = (int)Input::get('quantity');
        if ($quantity <= 0 || !$product)
            return \Redirect::to('/store')->with('message', 'provide Valid shopping data');
        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'qty' => $quantity,
            'options' => [
                'image' => $product->image
            ]
        ));

        return \Redirect::to('store/cart/items');
    }

    public function getCart()
    {
        return \View::make('store.cart')->with('products', \Cart::content());
    }

    public function getRemoveitem($identifier)
    {
        \Cart::remove($identifier);

        return \Redirect::to('/store/cart/items');
    }

    public function getContact()
    {
        return \View::make('store.contact');
    }
}
