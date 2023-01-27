<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.view', ['categories' => $categories]);
    }

    public function AddView()
    {
        return view('category.add');
    }

    public function AddCategory(Request $req)
    {
        $category = new Category();
        $category->category_name = $req->name;
        $category->category_description = $req->description;
        $category->category_other_details = $req->other;
        $category->save();

        return redirect('admin/category')
            ->with('successfull', $req->name . ' has been successfully added!');
    }

    public function ShowCategory($id)
    {
        $category = Category::find($id);
        return view('category.edit', ['category' => $category]);
    }

    public function EditCategory(Request $req, $id)
    {
        $category = Category::find($id);
        $category->category_name =              $req->name;
        $category->category_description =       $req->description;
        $category->category_other_details =     $req->other;
        $category->save();

        return redirect('admin/category')
            ->with('successfull', $category['category_name'] . ' has been successfully edited!');
    }

    public function DeleteCategory($id)
    {
        $category = Category::find($id);

        try {
            $category->delete();
            return redirect('admin/category')
                ->with('successfull', 'Category ' . $category['category_name'] . ' has been successfully deleted!');
        } catch (Exception $ex) {
            return redirect('admin/category')
                ->with('error_title', 'Cannot Delete ' . $category['category_name'])
                ->with('error_msg', 'Category cannot be deleted. There are connected data on this value.');
        }
    }
}
