<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category.view', ['categories' => $categories]);
    }

    public function AddView(){
        return view('category.add');
    }

    public function AddCategory(Request $req){
        $category = new Category();
        $category->category_name = $req->name;
        $category->category_description = $req->description;
        $category->category_other_details = $req->other;
        $category->save();

        return redirect('admin/category');
    }
}
