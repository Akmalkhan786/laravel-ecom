<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductsAttribute;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        if ($request->isMethod('post')){
            if (empty($request->input('category_id'))){
                return redirect()->back()->with('error', 'Under category is missing!');
            }
            $product = new Product;
            $product->category_id = $request->input('category_id');
            $product->product_name = $request->input('product_name');
            $product->product_code = $request->input('product_code');
            $product->product_color = $request->input('product_color');
            if (!empty($request->input('description'))){
                $product->description = $request->input('description');
            } else {
                $product->description = "";
            }
            if (!empty($request->input('care'))){
                $product->care = $request->input('care');
            } else {
                $product->care = "";
            }
            $product->price = $request->input('price');
            // Upload Image
            if ($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999) .'.'. $extension;
                    $large_image_path = 'images/backend_images/products/large/'.$fileName;
                    $medium_image_path = 'images/backend_images/products/medium/'.$fileName;
                    $small_image_path = 'images/backend_images/products/small/'.$fileName;
                    // Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    // Save in Database
                    $product->image = $fileName;
                }
            }
            $product->save();
            return redirect(url('/admin/view-products'))->with('success', 'Product Add Successfully!');
        }

        // Dropdown Categories Start
        $categories = Category::where('parent_id', 0)->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where('parent_id', $cat->id)->get();
            foreach ($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp; --&nbsp;".$sub_cat->name."</option>";
            }
        }
        // Dropdown Categories Ends
        return view('admin.products.add-product', compact('categories_dropdown'));
    }

    public function editProduct(Request $request, $id = null){
        if ($request->isMethod('post')){
            $data = $request->all();
//            echo '<pre>'; print_r($data); die;

            // Upload Image
            if ($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999) .'.'. $extension;
                    $large_image_path = 'images/backend_images/products/large/'.$fileName;
                    $medium_image_path = 'images/backend_images/products/medium/'.$fileName;
                    $small_image_path = 'images/backend_images/products/small/'.$fileName;
                    // Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                }
            } else {
                $fileName = $data['current_image'];
            }
            if (empty($data['description'])){
                $data['description'] = '';
            }
            if (empty($data['care'])){
                $data['care'] = "";
            }
            Product::where('id', $id)->update(['category_id'=>$data['category_id'], 'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'care'=>$data['care'],'price'=>$data['price'],'image'=>$fileName]);
            return redirect('/admin/view-products')->with('success', 'Product Updated Successfully!');
        }
        $product = Product::where('id', $id)->first();

        // Dropdown Categories Start
        $categories = Category::where('parent_id', 0)->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $cat){
            if ($cat->id == $product->category_id){
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories = Category::where('parent_id', $cat->id)->get();
            foreach ($sub_categories as $sub_cat){
                if ($sub_cat->id == $product->category_id){
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected.">&nbsp; --&nbsp;".$sub_cat->name."</option>";
            }
        }
        // Dropdown Categories Ends
        return view('admin.products.edit-product', compact('product', 'categories_dropdown'));
    }

    public function viewProducts(){
        $products = Product::orderBy('id', 'desc')->get();
        foreach ($products as $key => $val){
            $category_name = Category::where('id', $val->category_id)->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view-products', compact('products'));
    }

    public function deleteProduct($id = null){
        $product = Product::findOrFail($id);
        unlink('images/backend_images/products/small/'.$product->image);
        unlink('images/backend_images/products/medium/'.$product->image);
        unlink('images/backend_images/products/large/'.$product->image);
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully!');
    }

    public function deleteProductImage($id = null){
        $product = Product::findOrFail($id);
        unlink('images/backend_images/products/small/'.$product->image);
        unlink('images/backend_images/products/medium/'.$product->image);
        unlink('images/backend_images/products/large/'.$product->image);
        $product->update(['image' => '']);
        return redirect()->back()->with('success', 'Product Image has been Deleted Successfully!');
    }

    public function addAttributes(Request $request, $id = null){
        $product = Product::with('attributes')->where('id', $id)->first();
//        $product = json_decode(json_encode($product));
//        echo '<pre>'; print_r($product); die;
        if ($request->isMethod('post')){
            $data = $request->all();
            foreach ($data['sku'] as $key => $value){
                if (!empty($value)){
                    // Sku Check
                    $attrCountSku = ProductsAttribute::where('sku', $value)->count();
                    if ($attrCountSku > 0){
                        return redirect('/admin/add-attributes/'. $product->id)->with('error', 'SKU already exist! Please add another SKU.');
                    }
                    // Size Check
                    $attrCountSize = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($attrCountSize > 0){
                        return redirect('/admin/add-attributes/'. $product->id)->with('error', ''.$data['size'][$key].' Size already exist for this product! Please add another Size.');
                    }
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('/admin/add-attributes/'. $product->id)->with('success', 'Product attributes added successfully!');
        }
        return view('admin.products.add-attributes', compact('product'));
    }

    public function addImages(Request $request, $id = null){
        $product = Product::with('attributes')->where('id', $id)->first();
        if ($request->isMethod('post')){
            $data = $request->all();
            if ($request->hasFile('image')){
                $files = $request->file('image');
                echo '<pre>'; print_r($files); die;
            }
        }
        return view('admin.products.add-image', compact('product'));
    }

    public function deleteAttributes($id = null){
        ProductsAttribute::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product Attribute Deleted Successfully!');
    }

    public function products($url = null){
        // Show 404 page if category Url does not exist
        $countCategory = Category::where(['url' => $url, 'status' => 1])->count();
        if ($countCategory == 0){
            abort(404);
        }
        $categories = Category::with('categories')->where('parent_id', 0)->get();
        $category = Category::where('url', $url)->first();
        if ($category->parent_id == 0){
            $subCategories = Category::where('parent_id', $category->id)->get();
            foreach ($subCategories as $subCategory){
                $cat_ids[] = $subCategory->id;
            }
            $products = Product::whereIn('category_id', $cat_ids)->get();
//            $products = json_decode(json_encode($products));
//            echo '<pre>'; print_r($products); die;
        } else {
            $products = Product::where('category_id', $category->id)->get();
        }
        return view('products.listing', compact('categories', 'category', 'products'));
    }

    public function product($id = null){
        $product = Product::with('attributes')->where('id', $id)->first();
        $categories = Category::with('categories')->where('parent_id', 0)->get();
        return view('products.detail', compact('categories', 'product'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        $proArr = explode('-', $data['idSize']);
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0], 'size' => $proArr[1]])->first();
        echo $proAttr->price;
    }
}
