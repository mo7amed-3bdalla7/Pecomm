<?php
/**
 * Created by PhpStorm.
 * User: m7md
 * Date: 09/11/16
 * Time: 09:23
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Category;



class CategoriesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('csrf');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('categories.index')
            ->with('categories', Category::all());
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Category::$rules);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->get('name');
            $category->save();
            return \Redirect::to('admin/categories')
                ->with('message', 'Category Created');


        }

        return \Redirect::to('admin/categories')
            ->with('message', 'Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id)
    {
        //\Input::get('id')
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return \Redirect::to('admin/categories')
                ->with('message', 'Category Deleted');
        }

        return \Redirect::to('admin/categories')
            ->with('message', 'something went wrong, please try again');
    }



}