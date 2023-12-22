<?php

namespace App\Http\Controllers;

use App\Models\admins_Roles;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\fileExists;

class categoryController extends Controller
{

    public function categories(){
        Session::put('page','categories');
        $categories = Category::with('parentcategory')->get();
       // dd($categories);

       // set admin/subadmin permission for categories
       $categoriesmoduleCount = admins_Roles::where([
        'subadmin_id'=>Auth::guard('admin')->user()->id,
        'module'=>'categories','view_access'=> 0,'edit_access'=> 0, 'full_access' => 0
        ])->count();
        $categoriesmodule = array();

        if(Auth::guard('admin')->user()->type=="admin"){
            $categoriesmodule['view_access']= 1;
            $categoriesmodule['edit_access']= 1;
            $categoriesmodule['full_access']= 1;
        } else if($categoriesmoduleCount == 1){
            $message = "This feature is Restricted for you!";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $categoriesmodule = admins_Roles::where(['subadmin_id'=>Auth::guard('admin')->user()->id, 'module'=>'categories'])->first()->toArray();
        }

        return view('admin.categories.category')->with(compact('categories','categoriesmodule'));
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

    public function deleteCategoryimage($id) {

        // Get image name
        $categoryImage = Category::select('category_image')->where('id',$id)->first();

        //Get image path
        $category_image_path = 'frontend/img/category/';
        //Check if image exists in directory and delete image from path
        if(fileExists($category_image_path.$categoryImage->category_image)){
            unlink($category_image_path.$categoryImage->category_image);
        }
        //Delete image from database
        Category::where('id',$id)->update(['category_image'=>'']);

        return redirect()->back()->with('success_message','Category-image Deleted Successfully!');
    }

    public function addEditCategory(Request $request, $id = null) {
        $getCategories = Category::getCategories();
        Session::put('page','add-edit-category');
        if($id == ""){
            $title = "Add Category";
            $category = new Category();
            $message = "Category Add Successfully!";
        } else {
            $title = "Edit Category";
            $category =Category::find($id);
            //dd($category);
            $message = "Category Updated Successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //dd( $data);

            if($id ==""){
                $rules = [
                    'parent_id'=>'required',
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

                    $category->parent_id = $data['parent_id'];
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

        return view('admin.categories.add-edit-category')->with(compact('title','category','getCategories'));

    }

}
