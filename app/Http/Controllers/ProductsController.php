<?php
/**
 * Created by PhpStorm.
 * User: m7md
 * Date: 09/11/16
 * Time: 09:23
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;


class ProductsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('csrf');
        $this->middleware('admin');

    }

    public function index()
    {
        $categories = array();
        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }
        return view('products.index')
            ->with('products', Product::all())
            ->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Product::$rules);

        if ($validator->passes()) {
            $Product = new Product();
            $Product->category_id = $request->get('category_id');
            $Product->title = $request->get('title');
            $Product->description = $request->get('description');
            $Product->price = $request->get('price');

            $image = $request->file('image');
            $filename = date('Y-m-d-H:i:s') . "-" . $image->getClientOriginalName();
            \Image::make($image->getRealPath())->resize(468, 249)->save('img/products/' . $filename);
            $Product->image = 'img/products/' . $filename;

            $Product->save();
            return \Redirect::to('admin/products')
                ->with('message', 'Product Created');


        }

        return \Redirect::to('admin/products')
            ->with('message', 'Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id)
    {
        $Product = Product::find($id);
        if ($Product) {
            \File::delete($Product->image);
            $Product->delete();
            return \Redirect::to('admin/products')
                ->with('message', 'Product Deleted');
        }

        return \Redirect::to('admin/products')
            ->with('message', 'something went wrong, please try again');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->availability = $request->get('availability');
            $product->save();

            return \Redirect::to('admin/products')
                ->with('message', 'product Updated');
        }
        return \Redirect::to('admin/products')
            ->with('message', 'Invalid product');
    }

}