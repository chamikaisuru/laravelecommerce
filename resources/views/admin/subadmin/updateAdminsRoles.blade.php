@extends('admin.layout.layout')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Roles/Permission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">SubAdmins</li>
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
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{Session::get('success_message') }}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button> --}}
                </div>
                @endif
            <form action="{{ url('admin/update-role/'.$id) }}" method="post" id="subadminForm" name="subadminForm">
                @csrf
                <input type="hidden" name="subadmin_id" value="{{ $id }}">
                <div class="card-body ">
                    {{-- <div class="form-group col-md-6">
                        <label for="email">Email*</label>
                        <input type="email" @if ($subadminData['email'] != "") disabled style="background-color:#666 " @else required @endif class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" @if (!empty($subadminData['email'])) value="{{ $subadminData['email'] }}" @endif>
                      </div>
                      @error('email')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror --}}
                      @if (!empty($subadminRole))
                      @foreach ($subadminRole as $role)
                          @if ($role['module'] =="cms_pages")
                              @if ($role['view_access'] == 1)
                                  @php $viewcmspage="checked"; @endphp
                                  @else
                                  @php $viewcmspage=""; @endphp
                              @endif
                              @if ($role['edit_access'] == 1)
                                  @php $editcmspage="checked"; @endphp
                                  @else
                                  @php $editcmspage=""; @endphp
                              @endif
                              @if ($role['full_access'] == 1)
                                  @php $fullcmspage="checked"; @endphp
                                  @else
                                  @php $fullcmspage=""; @endphp
                              @endif
                          @endif
                      @endforeach
                      @endif
                      <div class="form-group col-md-6">
                     <label for="cms_pages">CMS Pages:&nbsp;&nbsp;&nbsp;</label>
                     <input type="checkbox" name="cms_pages[view]" value="1" @if (@isset($viewcmspage)) {{ $viewcmspage }} @endif>&nbsp;&nbsp;View Access&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name="cms_pages[edit]" value="1" @if (@isset($editcmspage)) {{ $editcmspage }} @endif>&nbsp;&nbsp;View/Edit Access&nbsp;&nbsp;&nbsp;
                      <input type="checkbox"  name="cms_pages[full]" value="1" @if (@isset($fullcmspage)) {{ $fullcmspage }} @endif>&nbsp;&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                      </div>
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

