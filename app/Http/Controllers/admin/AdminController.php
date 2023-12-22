<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admins_Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

use function PHPSTORM_META\type;

class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
    return view('admin.dashboard');

    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:30'
            ];

            $customMessage = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
        ];

            $this->validate($request,$rules,$customMessage);

            if(Auth::guard('admin')->attempt(['email' => $data['email'],'password'=> $data['password']])){
                // Remember Admin Email & Password with cookies
                if(isset($data['remember'])&&!empty($data['remember'])){
                    setcookie('email',$data['email'],time()+3600);
                    setcookie('password',$data['password'],time()+3600);
                } else{
                    setcookie("email","");
                    setcookie("password","");
                }

                return redirect(route('admin.dashboard'));
            } else{
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(route('admin.logout'));
    }

    public function updatePassword(Request $request){
        Session::put('page','updatePassword');
        if($request->isMethod('post')){
            $data = $request->all();
            // Check if Current Password is Correct
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
                //Check if new Password and conifrm Password is matching
                if($data['new_pwd'] == $data['confrim_pwd']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success_message','password has been Updated Successfully!');

                } else {
                    return redirect()->back()->with('error_message','New password and Confirm Password did not match');
                }
            }else {
                return redirect()->back()->with('error_message','New Password & Retype Password is not Match!');
            }
        }
        return view('admin.updatePassword');
    }

    public function checkcurrentPassword(Request $request){

        $data = $request->all();
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            return true;
        }else{
            return false;
        }
    }


    public function updateAdminDetails(Request $request){
        Session::put('page','updateAdminDetails');
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'mobile' => 'required|numeric|digits:10',
                'image' => 'image',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid Name is required',
                'name.max' => 'Valid Name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required',
                'mobile.digits' => 'Valid Mobile is required',
                'image.image' => 'Valid image is required',

        ];

            $this->validate($request,$rules,$customMessage);

            if($request->hasFile('image')){
                $imageTmp = $request->file('image');
                if($imageTmp->isValid()){
                    // Get Image Extension
                    $extension = $imageTmp->getClientOriginalExtension();
                    // Generate New Image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'admin/img/photos/'.$imageName;

                   // Image::make($imageTmp)->save($imagePath);
                   Image::make($imageTmp)->save($imagePath);

                }
            } elseif (!empty($data['current_img'])){
                $imageName = $data['current_img'];
            }
        else {
            $imageName = '';
        }

            //update Admin Details
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name' => $data['name'],'mobile' => $data['mobile'],'image' => $imageName]);

            return redirect()->back()->with('success_message','Admin Details has been Updated Successfully!');
        }

        return view('admin.updateAdminDetails');
    }


    public function subadmin(){
        Session::put('page','sub-admin');
        $subadmins = Admin::where('type','subadmin')->get();
        return view('admin.subadmin.subadmin')->with(compact('subadmins'));
    }


    public function updateSubAdminStatus(Request $request){
       $subadminData = $request->all();
        // echo $subadminData ;
        // die;
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active"){
                $status = 0;
            } else{
                $status = 1;
            }
            Admin::where('id',$data['subadmin_id'])->update(['status'=>$status]);
           return response()->json(['status' => $status, 'subadmin_id'=>$data['subadmin_id']]);
        }
    }

    public function Deletesubadmin($id)
    {
        Admin::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Sub Admin Deleted Successfully!');
    }

    public function addEditSubadmin(Request $request, $id=null){
        Session::put('page','edit-subadmin');
        if($id == ""){
            $title="Add SubAdmin";
            $subadminData = new Admin();
            $message = "SubAdmin Add Successfully!";
        }else{
            $title="Edit SubAdmin";
            $subadminData = Admin::find($id);
            $message = "SubAdmin Updated Successfully!";
        }

        if($request->isMethod('post')){
            $data=$request->all();

            if($id == ""){
                //dd($data);
                $subadmincount = Admin::where('email',$data['email'])->count();
                if ($subadmincount > 0 ) {
                    return redirect()->back()->with('error_message','Email already exists! Please try another one.');
                }
            }

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'mobile' => 'required|numeric|digits:10',
                // 'email' => 'required|email|max:255',
                // 'password' => 'required|max:30',
                'image' => 'image',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid Name is required',
                'name.max' => 'Valid Name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid Mobile is required',
                'mobile.digits' => 'Valid Mobile is required',
                // 'email.required' => 'Email is required',
                // 'email.email' => 'Valid Email is required',
                // 'password.required' => 'Password is required',
                'image.image' => 'Valid image is required',
        ];

            $this->validate($request,$rules,$customMessage);
            //upload subadmin image
            if($request->hasFile('image')){
                $imageTmp = $request->file('image');
                if($imageTmp->isValid()){
                    // Get Image Extension
                    $extension = $imageTmp->getClientOriginalExtension();
                    // Generate New Image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'admin/img/photos/'.$imageName;

                   Image::make($imageTmp)->save($imagePath);

                } elseif (!empty($data['current_img'])){
                        $imageName = $data['current_img'];
                    }
                else {
                    $imageName = '';
                }

                $subadminData->image = $imageName;
                $subadminData->name = $data['name'];
                $subadminData->mobile = $data['mobile'];
                if($id ==""){
                    $subadminData->email = $data['email'];
                    $subadminData->type = 'subadmin';
                }
                if($data['password']!=""){
                    $subadminData->password = bcrypt($data['password']);
                }
                $subadminData->status = 1;
                $subadminData->save();

            }

            return redirect('admin/subAdmin')->with('success_message',$message);

        }
        return view('admin.subadmin.add-edit-subadmin')->with(compact('title','subadminData'));

    }

    public function updateAdminsRoles(Request $request, $id) {
        if ($request->isMethod('post')) {
            $data = $request->all();
           // dd($data);

            // Delete all earlier Roles for subadmin
            admins_Roles::where('subadmin_id', $id)->delete();

            // update Admins roles/Permission
            foreach (['cms_pages', 'categories'] as $module) {
                admins_Roles::updateOrCreate(
                    [
                        'subadmin_id' => $data['subadmin_id'],
                        'module' => $module,
                    ],
                    [
                        'view_access' => isset($data[$module]['view']) ? $data[$module]['view'] : 0,
                        'edit_access' => isset($data[$module]['edit']) ? $data[$module]['edit'] : 0,
                        'full_access' => isset($data[$module]['full']) ? $data[$module]['full'] : 0,
                    ]
                );
            }

            $message = "Subadmin Role Add Successfully";
            return redirect()->back()->with('success_message', $message);
        }

        $subadminRole = admins_Roles::where('subadmin_id', $id)->get()->toArray();
        $subadminDetails = Admin::where('id', $id)->first()->toArray();
        $title = "Update " . $subadminDetails['name'] . "'s sub Admin Roles/Permission";

        return view('admin.subadmin.updateAdminsRoles')->with(compact('title', 'id', 'subadminRole'));
    }


}
