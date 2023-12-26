<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class productsController extends Controller
{
    public function products() {

        Session::put('page','products');
        $products = Product::with('filters')->with('category')->get()->toArray();
        //dd($products);
        return view('admin.products.product')->with(compact('products'));
    }

    public function updateProductStatus(Request $request) {

        if($request->ajax()){
            $data = $request->all();
           // dd($request);
            if($data['status'] == "Active"){
                $status = 0;
            } else{
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
           return response()->json(['status' => $status, 'product_id'=>$data['product_id']]);
        }

    }

    public function addEditProduct(Request $request, $id = null) {
        $getProducts = Product::getCategories();
        Session::put('page','add-edit-product');
        if($id == ""){
            $title = "Add Product";
            $product = new Product();
            $message = "Product Add Successfully!";
        } else {
            $title = "Edit Product";
            $product =Product::find($id);
            //dd($category);
            $message = "Product Updated Successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //dd( $data);

            if($id ==""){
                $rules = [
                    'product_name'=>'required',
                    'category_name' => 'required',
                    'image' => 'image',
                    'description' => 'required',
                    'url' => 'required|unique:categories',
                ];
            } else {
                $rules = [
                    'parent_id'=>'required',
                    'category_name' => 'required',
                    'image' => 'image',
                    'description' => 'required',
                    'url' => 'required',
                ];
            }


            $customMessage = [
                                'parent_id' => 'Category Level is required',
                                'category_name.required' => 'category name is required',
                                'image.image' => 'Valid image is required',
                                'description.required' => 'category Description is required',
                                'url.required' => 'category URL is required',
                                'url.unique' => 'unique category URL is required',
                            ];

            $this->validate($request,$rules,$customMessage);

            if($request->hasFile('category_image')){
                $imageTmp = $request->file('category_image');
                if($imageTmp->isValid()){
                    // Get Image Extension
                    $extension = $imageTmp->getClientOriginalExtension();
                    // Generate New Image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'frontend/img/category/'.$imageName;
                    // upload image to database
                   Image::make($imageTmp)->save($imagePath);

                }
            }
            elseif (!empty($data['current_img'])){
                $imageName = $data['current_img'];
                //dd($imageName);
            }
        else {
            $imageName = '';
        }

        if(empty(isset($data['category_discount']))){
            $data['category_discount']=0;
        }

                    $product->category_id = $data['category_id'];
                    $product->brand_id = $data['brand_id'];
                    $product->product_name = $data['product_name'];
                    $product->product_code = $data['product_code'];
                    $product->product_color = $data['product_color'];
                    $product->family_color = $data['family_color'];
                    $product->group_code = $data['group_code'];
                    $product->product_price = $data['product_price'];
                    $product->product_discount = $data['product_discount'];
                    $product->discount_type = $data['discount_type'];
                    $product->final_price = $data['final_price'];
                    $product->product_weight = $data['product_weight'];
                    $product->product_video = $data['product_video'];
                    $product->description = $data['description'];
                    $product->wash_care = $data['wash_care'];
                    $product->keywords = $data['keywords'];
                    $product->filters = $data['filters'];
                    $product->meta_title = $data['meta_title'];
                    $product->meta_description = $data['meta_description'];
                    $product->meta_keywords = $data['meta_keywords'];
                    $product->is_featured = $data['is_featured'];
                    $product->status = 1;
                    //dd($category);
                    $product->save();

                    return redirect('admin/products')->with('success_message',$message);
        }

        return view('admin.products.add-edit-product')->with(compact('title','product','getProducts'));

    }

    public function deleteProduct($id) {

        Product::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Product Deleted Successfully!');
    }
}
