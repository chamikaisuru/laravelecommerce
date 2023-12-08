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

            <!-- /.row -->
            <form @if (empty($cmspage['id'])) action="{{ url('admin/add-edit-cmspage') }}" @else action="{{ url('admin/add-edit-cmspage/'.$cmspage['id']) }}" @endif method="post" id="cmsForm" name="cmsForm">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="Inputtitle">Title*</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter Title" @if (!empty($cmspage['title'])) value="{{ $cmspage['title'] }}" @endif>
                  </div>
                  @error('title')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label>Description*</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3" id="description" name="description" placeholder="Enter Description" >@if (!empty($cmspage['description'])) {{ $cmspage['description'] }} @endif</textarea>
                  </div>
                  @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="url">URL*</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="URL" @if (!empty($cmspage['url'])) value="{{ $cmspage['url'] }}" @endif>
                  </div>
                  @error('url')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" placeholder="Enter Meta Title" @if (!empty($cmspage['meta_title'])) value="{{ $cmspage['meta_title'] }}" @endif>
                  </div>
                  @error('meta_title')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Enter Meta Description" @if (!empty($cmspage['meta_description'])) value="{{ $cmspage['meta_description'] }}" @endif>
                  </div>
                  @error('meta_description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" id="meta_keywords" placeholder="Enter Meta Keywords" @if (!empty($cmspage['meta_keywords'])) value="{{ $cmspage['meta_keywords'] }}" @endif>
                  </div>
                  @error('meta_keywords')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror


                <!-- /.card-body -->

                <div class="card-footer">
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

