@extends('admin.layout.layout')
@section('content')
   <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">CMS Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
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
                  <h3 class="card-title">CMS Pages</h3>
                  @if ($cmsPagemodule['edit_access']== 1 || $cmsPagemodule['full_access']== 1)
                  <a href="{{ url('admin/add-edit-cmspage') }}" style="width: 150px; float:right; display:inline-block" class="btn btn-block btn-primary">Add CMS Page</a>
                  @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="cms_page" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>URL</th>
                      <th>Created On</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($cmspages as $page)
                        <tr>
                            <td>{{ $page['id'] }}</td>
                            <td>{{ $page['title'] }}</td>
                            <td>{{ $page['url'] }}</td>
                            <td>{{ date("F j, Y, g:i a", strtotime($page['created_at']))}}</td>
                            <td>
                                @if ($cmsPagemodule['edit_access']== 1 || $cmsPagemodule['full_access']== 1)
                                @if ($page['status'] == 1)
                                <a class="updateCmspageStatus" id="page-{{ $page['id'] }}" page_id="{{ $page['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                @else
                                <a class="updateCmspageStatus" id="page-{{ $page['id'] }}" page_id="{{ $page['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive" style="color: gray"></i></a>
                                @endif
                                @endif
                                &nbsp;&nbsp;
                                @if ($cmsPagemodule['edit_access']== 1 || $cmsPagemodule['full_access']== 1)
                                <a class="editcmspage" href="{{ url('admin/add-edit-cmspage/'.$page['id']) }}" ><i class="fas fa-edit" aria-hidden="true"></i></a>
                                @endif
                                &nbsp;&nbsp;
                                @if ($cmsPagemodule['full_access']== 1)
                                <a class="confirmDelete" name="cms page" title="Delete CMS page" href="javascript:void(0)" record="cmspage" recordid="{{ $page['id'] }}"  {{--href="{{ url('admin/delete-cmspage/'.$page['id']) }}" --}}><i class="fa fa-trash" aria-hidden="true"></i></a>
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
