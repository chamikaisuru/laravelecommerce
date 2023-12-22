@extends('admin.layout.layout')
@section('content')
   <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categories Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                @if(session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
                @endif
             <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Categories</h3>
                  @if ($categoriesmodule['edit_access']== 1 || $categoriesmodule['full_access']== 1)
                  <a href="{{ url('admin/add-edit-category') }}" style="width: 150px; float:right; display:inline-block" class="btn btn-block btn-primary">Add Categories</a>
                  @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="Categories" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>category Name</th>
                      <th>Parent category</th>
                      <th>URL</th>
                      <th>Created On</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category['id'] }}</td>
                            <td>{{ $category['category_name'] }}</td>
                            <td>
                            @if (isset($category['parentcategory']['category_name']))
                            {{$category['parentcategory']['category_name']}}
                            @endif
                            </td>
                            <td>{{ $category['url'] }}</td>
                            <td>{{ date("F j, Y, g:i a", strtotime($category['created_at']))}}</td>
                            <td>
                                @if ($categoriesmodule['edit_access']== 1 || $categoriesmodule['full_access']== 1)
                                @if ($category['status'] == 1)
                                <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                @else
                                <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id="{{ $category['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive" style="color: gray"></i></a>
                                @endif
                                @endif
                                &nbsp;&nbsp;
                                @if ($categoriesmodule['edit_access']== 1 || $categoriesmodule['full_access']== 1)
                                <a class="editcategory" href="{{ url('admin/add-edit-category/'.$category['id']) }}" ><i class="fas fa-edit" aria-hidden="true"></i></a>
                                @endif
                                &nbsp;&nbsp;
                                @if ($categoriesmodule['full_access']== 1)
                                <a class="confirmDelete" title="Delete Category" href="javascript:void(0)" record="category" recordid="{{ $category['id'] }}"  {{--href="{{ url('admin/delete-cmspage/'.$page['id']) }}" --}}><i class="fa fa-trash" aria-hidden="true"></i></a>
                                @endif
                            </td>
                          </tr>
                        @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
