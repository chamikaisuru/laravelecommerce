@extends('admin.layout.layout')
@section('content')
   <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sub Admins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sub Admins</li>
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
                  <h3 class="card-title">Sub Admins</h3>
                  <a href="{{ url('admin/add-edit-subadmin') }}" style="width: 150px; float:right; display:inline-block" class="btn btn-block btn-primary">Add sub Admin</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="subadmintbl" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Created On</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($subadmins as $subadmin)
                        <tr>
                            <td>{{ $subadmin->id }}</td>
                            <td>{{ $subadmin->name }}</td>
                            <td>{{ $subadmin->mobile }}</td>
                            <td>{{ $subadmin->email}}</td>
                            <td>{{ date("F j, Y, g:i a", strtotime($subadmin->created_at))}}</td>
                            <td>

                                @if ($subadmin->status == 1)
                                <a class="subadminStatus" id="subadmin-{{ $subadmin->id }}" subadmin_id="{{ $subadmin->id }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                @else
                                <a class="subadminStatus" id="subadmin-{{ $subadmin->id }}" subadmin_id="{{ $subadmin->id }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive" style="color: gray"></i></a>
                                @endif
                                &nbsp;&nbsp;
                                <a class="editsubadmin" href="{{ url('admin/add-edit-subadmin/'.$subadmin->id) }}" ><i class="fas fa-edit" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;
                                &nbsp;&nbsp;
                                <a class="editpermission" href="{{ url('admin/update-role/'.$subadmin->id) }}" ><i class="fas fa-unlock" aria-hidden="true"></i></a>
                                &nbsp;&nbsp;
                                <a class="confirmDelete" name="Sub Admin" title="Delete Sub Admin" href="javascript:void(0)" record="subadmin" recordid="{{ $subadmin->id }}"  {{--href="{{ url('admin/delete-cmspage/'.$page['id']) }}" --}}><i class="fa fa-trash" aria-hidden="true"></i></a>

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
