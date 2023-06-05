<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Info;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $info = Info::all()->first();
        $categories = DB::table('categories')->get();
        return view('category.view', [
            'categories' => $categories,
            'info' => $info,
        ]);
    }

    public function AddView()
    {
        $info = Info::all()->first();
        return view('category.add')
            ->with(['info' => $info,]);
    }

    public function AddCategory(Request $req)
    {
        $category = new Category();
        $category->category_name = $req->name;
        $category->category_description = $req->description;
        $category->category_other_details = $req->other;
        $category->save();

        $info = Info::all()->first();

        return redirect('admin/category')
            ->with([
                'successfull' => $req->name . ' has been successfully added!',
                'info' => $info,
            ]);
    }

    public function ShowCategory($id)
    {
        $category = Category::find($id);
        $info = Info::all()->first();

        return view(
            'category.edit',
            [
                'category' => $category,
                'info' => $info,
            ]
        );
    }

    public function EditCategory(Request $req, $id)
    {
        $category = Category::find($id);
        $category->category_name =              $req->name;
        $category->category_description =       $req->description;
        $category->category_other_details =     $req->other;
        $category->save();

        $info = Info::all()->first();

        return redirect('admin/category')
            ->with([
                'successfull' => $category['category_name'] . ' has been successfully edited!',
                'info' => $info,
            ]);
    }

    public function DeleteCategory($id)
    {
        $category = Category::find($id);
        $info = Info::all()->first();

        try {
            $category->delete();
            return redirect('admin/category')
                ->with([
                    'successfull' => 'Category ' . $category['category_name'] . ' has been successfully deleted!',
                    'info' => $info,
                ]);
        } catch (Exception $ex) {

            return redirect('admin/category')
                ->with('error_title', 'Cannot Delete ' . $category['category_name'])
                ->with('error_msg', 'Category cannot be deleted. There are connected data on this value.')
                ->with('info', $info);
        }
    }
}
