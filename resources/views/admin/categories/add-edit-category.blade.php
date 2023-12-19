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
            <form @if (empty($category['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$category['id']) }}" @endif method="post" id="categoryForm" name="category" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="Inputtitle">Category Name*</label>
                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" id="category_name" placeholder="Enter Category Name" @if (!empty($category['category_name'])) value="{{ $category['category_name'] }}" @endif>
                  </div>
                  @error('category_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="image">Category Image</label>
                    <input type="file" class="form-control" name="category_image" id="category_image" placeholder="Choose Category Image">
                    @if (!empty($category['category_image']))
                    <a target="_blank" href="{{ url('frontend/img/category/'.$category['category_image'])}}">View Photo</a>
                    <input type="hidden" name="current_img" id="current_img" value="{{ $category['category_image'] }}">
                    @endif
                </div>
                  <div class="form-group">
                    <label for="category_discount">Category Discount</label>
                    <input type="text" class="form-control @error('category_discount') is-invalid @enderror" name="category_discount" id="category_discount" placeholder="Enter Category Discount" @if (!empty($category['category_discount'])) value="{{ $category['category_discount'] }}" @endif>
                  </div>
                  @error('category_discount')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label>Category Description*</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3" id="description" name="description" placeholder="Enter Description" >@if (!empty($category['description'])) {{ $category['description'] }} @endif</textarea>
                  </div>
                  @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="url">URL*</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="URL" @if (!empty($category['url'])) value="{{ $category['url'] }}" @endif>
                  </div>
                  @error('url')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" placeholder="Enter Meta Title" @if (!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @endif>
                  </div>
                  @error('meta_title')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Enter Meta Description" @if (!empty($category['meta_description'])) value="{{ $category['meta_description'] }}" @endif>
                  </div>
                  @error('meta_description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" id="meta_keywords" placeholder="Enter Meta Keywords" @if (!empty($category['meta_keywords'])) value="{{ $category['meta_keywords'] }}" @endif>
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

