<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admins_Roles;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CmspagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','cms-pages');
        $cmspages = CmsPage::get()->toArray();
        //dd($cmspages);

        // set admin/subadmin permission for cms pages
        $cmspagemoduleCount = admins_Roles::where([
            'subadmin_id'=> Auth::guard('admin')->user()->id,
            'module'=>'cms_pages','view_access'=> 0,'edit_access'=> 0, 'full_access' => 0
            ])->count();
            //dd($cmspagemoduleCount);
        $cmsPagemodule = array();

        if(Auth::guard('admin')->user()->type=="admin"){
            $cmsPagemodule['view_access']= 1;
            $cmsPagemodule['edit_access']= 1;
            $cmsPagemodule['full_access']= 1;
        } else if($cmspagemoduleCount == 1){
            $message = "This feature is Restricted for you!";
            return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $cmsPagemodule = admins_Roles::where(['subadmin_id'=>Auth::guard('admin')->user()->id, 'module'=>'cms_pages'])->first()->toArray();
        }

       return view('admin.pages.cms_pages')->with(compact('cmspages','cmsPagemodule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        Session::put('page','cms-pages');
        if($id == ""){
            $title="Add CMS Page";
            $cmspage = new CmsPage();
            $message = "CMS Page Add Successfully!";
        }else{
            $title="Edit CMS Page";
            $cmspage = CmsPage::find($id);
            $message = "CMS Page Updated Successfully!";
        }
       // dd( $cmspage);

        if($request->isMethod('post')){
            $data=$request->all();
            // dd($data);

            $rules = [
                'title' => 'required',
                'description' => 'required',
                'url' => 'required',
            ];

            $customMessage = [
                'title.required' => 'Page Title is required',
                'description.required' => 'Page Description is required',
                'url.required' => 'Page URL is required',
        ];

            $this->validate($request,$rules,$customMessage);

            $cmspage->title = $data['title'];
            $cmspage->description = $data['description'];
            $cmspage->url = $data['url'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->status = 1;
            $cmspage->save();

            return redirect('admin/cms-Pages')->with('success_message',$message);

        }
        return view('admin.pages.add-edit-cmspage')->with(compact('title','cmspage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active"){
                $status = 0;
            } else{
                $status = 1;
            }
           CmsPage::where('id',$data['page_id'])->update(['status'=>$status]);
           return response()->json(['status' => $status, 'page_id'=>$data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::where('id',$id)->delete();
        return redirect()->back()->with('success_message','CMS Page Deleted Successfully!');
    }
}
