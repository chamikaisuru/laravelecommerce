<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;

class categoryController extends Controller
{

    public function categories(){
        Session::put('page','categories');
        $categories = Category::with('parentcategory')->get();
       // dd($categories);
        return view('admin.categories.category')->with(compact('categories'));
    }

    public function updateCategoeryStatus(Request $request) {
        if($request->ajax()){
            $data = $request->all();
            //dd($data);
            if($data['status'] == "Active"){
                $status = 0;
            } else{
                $status = 1;
            }
           Category::where('id',$data['category_id'])->update(['status'=>$status]);
           return response()->json(['status' => $status, 'category_id'=>$data['category_id']]);
        }
    }

    public function product(){

    }

     /**
     * Remove the specified resource from storage.
     */
    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Category Deleted Successfully!');
    }

    public function addEditCategory(Request $request, $id = null){
        Session::put('page','add-edit-category');
        if($id == ""){
            $title = "Add Category";
            $category = new Category();
            $message = "Category Add Successfully!";
        } else {
            $title = "Edit Category";
            $category =Category::find($id);
            $message = "Category Updated Successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //dd( $data);
            $rules = [
                        'category_name' => 'required',
                        'description' => 'required',
                        'url' => 'required',
                    ];

            $customMessage = [
                                'category_name.required' => 'category name is required',
                                'description.required' => 'category Description is required',
                                'url.required' => 'category URL is required',
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

                    $category->category_name = $data['category_name'];
                    $category->category_image = $imageName;
                    $category->category_discount = $data['category_discount'];
                    $category->description = $data['description'];
                    $category->url = $data['url'];
                    $category->meta_title = $data['meta_title'];
                    $category->meta_description = $data['meta_description'];
                    $category->meta_keywords = $data['meta_keywords'];
                    $category->status = 1;
                    //dd($category);
                    $category->save();

                    return redirect('admin/categories')->with('success_message',$message);
        }

        return view('admin.categories.add-edit-category')->with(compact('title','category'));

    }

}
