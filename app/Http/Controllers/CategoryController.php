<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            if (empty($data['status'])){
                $status = 0;
            } else {
                $status = 1;
            }
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->status = $status;
            $category->save();
            return redirect('/admin/view-categories')->with('success', 'Category add successfully');
        }
        $levels = Category::where('parent_id', 0)->get();
        return view('admin.categories.add-category', compact('levels'));
    }

    public function editCategory(Request $request, $id = null){
        if ($request->isMethod('post')){
            $category = Category::where('id', $id)->first();
            if (empty($request->input('status'))){
                $status = 0;
            } else {
                $status = 1;
            }
            $category->name = $request->input('category_name');
            $category->parent_id = $request->input('parent_id');
            $category->description = $request->input('description');
            $category->url = $request->input('url');
            $category->status = $status;
            $category->save();
            return redirect('/admin/view-categories')->with('success', 'Category Updated Successfully');
        }
        $category = Category::where('id', $id)->first();
        $levels = Category::where('parent_id', 0)->get();
        return view('admin.categories.edit-category', compact('category', 'levels'));
    }

    public function deleteCategory($id = null){
        $category = Category::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }

    public function viewCategories(){
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.view-categories', compact('categories'));
    }
}
