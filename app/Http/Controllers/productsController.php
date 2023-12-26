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
        $getProducts = Product::with('category');
        dd($getProducts);
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
                    'category_id'=>'required',
                    'product_name'=>'required',
                    'product_code' => 'required',
                    'product_color' => 'required',
                    'family_color' => 'required',
                    'group_code' => 'required',
                    'product_price' => 'required',
                    // 'product_discount' => 'required',
                    // 'product_weight' => 'required',
                    // 'product_video' => 'required',
                    'product_description' => 'required',
                    // 'wash_care' => 'required',
                    // 'search_keywords' => 'required',
                    // 'meta_title' => 'required',
                    // 'meta_description' => 'required',
                    // 'meta_keywords' => 'required',
                    // 'is_featured' => 'required',
                ];
            } else {
                $rules = [
                    'category_id'=>'required',
                    'product_name'=>'required',
                    'product_code' => 'required',
                    'product_color' => 'required',
                    'family_color' => 'required',
                    'group_code' => 'required',
                    'product_price' => 'required',
                    // 'product_discount' => 'required',
                    // 'product_weight' => 'required',
                    // 'product_video' => 'required',
                    'product_description' => 'required',
                    // 'wash_care' => 'required',
                    // 'search_keywords' => 'required',
                    // 'meta_title' => 'required',
                    // 'meta_description' => 'required',
                    // 'meta_keywords' => 'required',
                    // 'is_featured' => 'required',
                ];
            }


            $customMessage = [

                    'category_id'=>'Category is required',
                    'product_name.required'=>'product name is required',
                    'product_code' => 'product code is required',
                    'product_color' => 'product color is required',
                    'family_color' => 'family color is required',
                    'group_code' => 'group code is required',
                    'product_price' => 'product price is required',
                    // 'product_discount' => 'required',
                    // 'product_weight' => 'required',
                    // 'product_video' => 'required',
                    'product_description' => 'product description is required',
                    // 'wash_care' => 'required',
                    // 'search_keywords' => 'required',
                    // 'meta_title' => 'required',
                    // 'meta_description' => 'required',
                    // 'meta_keywords' => 'required',
                    // 'is_featured' => 'required',

                            ];

            $this->validate($request,$rules,$customMessage);

            if($request->hasFile('product_video')){
                $videoTmp = $request->file('product_video');
                if($videoTmp->isValid()){
                    // Get Image Extension
                    $extension = $videoTmp->getClientOriginalExtension();
                    // Generate New Image name
                    $videoName = rand(111,99999).'.'.$extension;
                    $videoPath = 'frontend/img/category/'.$videoName;
                    // upload image to database
                   Image::make($videoTmp)->save($videoPath);

                }
            }
            // elseif (!empty($data['current_img'])){
            //     $imageName = $data['current_img'];
            //     //dd($imageName);
            // }
        else {
            $videoName = '';
        }

        if(empty(isset($data['product_discount']))){
            $data['product_discount']=0;
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
                    $product->product_video = $videoName;
                    $product->description = $data['product_description'];
                    $product->wash_care = $data['wash_care'];
                    $product->keywords = $data['search_keywords'];
                    $product->fabric = $data['fabric'];
                    $product->Pattern = $data['Pattern'];
                    $product->sleeve_length = $data['sleeve_length'];
                    $product->style = $data['style'];
                    $product->fit = $data['fit'];
                    $product->occasion = $data['occasion'];
                    $product->neckline = $data['neckline'];
                    $product->closure = $data['closure'];
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
