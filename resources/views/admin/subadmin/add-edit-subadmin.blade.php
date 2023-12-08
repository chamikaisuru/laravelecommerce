@extends('admin.layout.layout')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }} Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{Session::get('error_message') }}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                </div>
                @endif
            <!-- /.row -->
            <form @if (empty($subadminData['id'])) action="{{ url('admin/add-edit-subadmin') }}" @else action="{{ url('admin/add-edit-subadmin/'.$subadminData['id']) }}" @endif method="post" id="subadminForm" name="subadminForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body ">
                    <div class="form-group col-md-6">
                        <label for="email">Email*</label>
                        <input type="email" @if ($subadminData['email'] != "") disabled style="background-color:#666 " @else required @endif class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" @if (!empty($subadminData['email'])) value="{{ $subadminData['email'] }}" @endif>
                      </div>
                      @error('email')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    <div class="form-group col-md-6">
                        <label for="meta_title">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password" @if (!empty($subadminData['password'])) value="{{ $subadminData['password'] }}" @endif>
                      </div>
                      @error('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  <div class="form-group col-md-6">
                    <label for="Inputtitle">Name*</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Name" @if (!empty($subadminData['name'])) value="{{ $subadminData['name'] }}" @endif>
                  </div>
                  @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group col-md-6">
                    <label>Mobile*</label>
                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Enter Mobile" @if (!empty($subadminData['mobile'])) value="{{ $subadminData['mobile'] }}" @endif>
                  </div>
                  @error('mobile')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror


                  <div class="form-group col-md-6">
                    <label for="image">Photo</label>
                    <input type="file" class="form-control" name="image" id="image" placeholder="Choose Profile Image">
                    @if (!empty($subadminData['image']))
                    <a target="_blank" href="{{ url('admin/img/photos/'.$subadminData['image'])}}">View Photo</a>
                    <input type="hidden" name="current_img" id="current_img" value="{{ $subadminData['image'] }}">
                    @endif
                  </div>

                <!-- /.card-body -->

                <div class="form-group col-md-6">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>


            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

