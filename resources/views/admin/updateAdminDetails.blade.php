@extends('admin.layout.layout')
@section('content')
   <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Admin Details</li>
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
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Admin Details</h3>
                </div>
                <!-- /.card-header -->
                @if(session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <!-- form start -->
                <form action="{{ route('admin.updateAdminDetails') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ Auth::guard('admin')->user()->email }}" placeholder="Enter email" readonly style="background-color:#666 " >
                      </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name"  value="{{ Auth::guard('admin')->user()->name }}" placeholder="Enter Name" >
                    </div>
                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="text" class="form-control" name="mobile" id="mobile" value="{{ Auth::guard('admin')->user()->mobile }}" placeholder="Enter Mobile Number">
                    </div>


                      <div class="form-group">
                        <label for="image">Photo</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Choose Profile Image">
                        @if (!empty(Auth::guard('admin')->user()->image))
                        <a target="_blank" href="{{ url('admin/img/photos/'.Auth::guard('admin')->user()->image)}}">View Photo</a>
                        <input type="hidden" name="current_img" id="current_img" value="{{ Auth::guard('admin')->user()->image }}">
                        @endif

                      </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
