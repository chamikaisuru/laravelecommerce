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
            <form @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$product['id']) }}" @endif method="post" id="productForm" name="product" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="form-group">
                    <label for="Inputtitle">Select Category*</label>
                    <select name="category_id" class="form-control">
                      <option value="">Select</option>
                        @foreach ($getCategories as $cat )
                        <option value="{{ $cat['id'] }}">{{ $cat['category_name'] }}</option>
                            @if (!empty($cat['sub_categories']))
                                @foreach ( $cat['sub_categories'] as $subCat )
                                <option  value="{{ $subCat['id'] }}">&nbsp;&nbsp;&nbsp;&raquo;&raquo;{{ $subCat['category_name'] }}</option>
                                        @if (!empty($subCat['sub_categories']))
                                            @foreach ( $subCat['sub_categories'] as $subsubCat )
                                            <option value="{{ $subsubCat['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&raquo;{{ $subsubCat['category_name'] }}</option>
                                            @endforeach
                                        @endif
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                  </div>
                  @error('category_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="Inputtitle">Product Name*</label>
                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" placeholder="Enter Product Name" @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                  </div>
                  @error('product_name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="Inputtitle">Product Code</label>
                    <input type="text" class="form-control @error('product_code') is-invalid @enderror" name="product_code" id="product_code" placeholder="Enter Product Code" @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                  </div>
                  @error('product_code')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="product_color">Product Color</label>
                    <input type="text" class="form-control @error('product_color') is-invalid @enderror" name="product_color" id="product_color" placeholder="Enter Product Color" @if (!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                  </div>
                  @error('product_color')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="family_color">Family Color</label>
                    <select name="family_color" class="form-control">
                        <option value="">Select</option>
                        <option value="Red">Red</option>
                        <option value="Green">Green</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Black">Black</option>
                        <option value="White">White</option>
                        <option value="Blue">Blue</option>
                        <option value="Orange">Orange</option>
                        <option value="Grey">Grey</option>
                        <option value="Silver">Silver</option>
                        <option value="Golden">Golden</option>
                    </select>
                  </div>
                  @error('family_color')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="group_code">Group Code</label>
                    <input type="text" class="form-control @error('group_code') is-invalid @enderror" name="group_code" id="group_code" placeholder="Enter Group Code" @if (!empty($product['group_code'])) value="{{ $product['group_code'] }}" @else value="{{ old('group_code') }}" @endif>
                  </div>
                  @error('group_code')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="text" class="form-control @error('product_price') is-invalid @enderror" name="product_price" id="product_price" placeholder="Enter Product Price" @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                  </div>
                  @error('product_price')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="product_discount">Product Discount</label>
                    <input type="text" class="form-control @error('product_discount') is-invalid @enderror" name="product_discount" id="product_discount" placeholder="Enter Product Discount" @if (!empty($category['product_discount'])) value="{{ $category['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                  </div>
                  @error('product_discount')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="product_weight">Product Weight</label>
                    <input type="text" class="form-control @error('product_weight') is-invalid @enderror" name="product_weight" id="product_weight" placeholder="Enter Product Weight" @if (!empty($category['product_weight'])) value="{{ $category['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                  </div>
                  @error('product_weight')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="product_video">Product Video</label>
                    <input type="file" accept="video/*" class="form-control" name="product_video" id="product_video" placeholder="Choose Product Video" @if (!empty($category['product_video'])) value="{{ $category['product_video'] }}" @else
                    value="{{ old('product_video') }}" @endif>
                    @if (!empty($product['product_video']))
                    <video width="320" height="240" controls>
                        <source src="{{ asset('frontend/video/product/'.$product['product_video']) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <a class="confirmDelete" title="Delete Product Video" href="javascript:void(0)" record="product-video" recordid="{{ $product['id'] }}"><i style="color: red" class="fa fa-trash"></i></a>
                    @endif
                    </div>
                  <div class="form-group">
                    <label>Product Description*</label>
                    <textarea class="form-control @error('product_description') is-invalid @enderror" rows="3" id="product_description" name="product_description" placeholder="Enter Product Description" >@if (!empty($product['product_description'])) {{ $product['product_description'] }} @else {{ old('product_description') }} @endif</textarea>
                  </div>
                  @error('product_description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label>Wash Care</label>
                    <input class="form-control @error('wash_care') is-invalid @enderror" id="wash_care" name="wash_care" placeholder="Enter Wash Care" >@if (!empty($product['wash_care'])) {{ $product['wash_care'] }} @else {{ old('wash_care') }} @endif>
                  </div>
                  @error('wash_care')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="search_keywords">Search Keywords</label>
                    <input type="text" class="form-control @error('search_keywords') is-invalid @enderror" id="search_keywords" name="search_keywords" placeholder="Search Keywords" @if (!empty($product['search_keywords'])) value="{{ $product['search_keywords'] }}" @else value="{{ old('search_keywords') }}" @endif>
                  </div>
                  @error('search_keywords')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" id="meta_title" placeholder="Enter Meta Title" @if (!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                  </div>
                  @error('meta_title')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" id="meta_description" placeholder="Enter Meta Description" @if (!empty($category['meta_description'])) value="{{ $category['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif>
                  </div>
                  @error('meta_description')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" id="meta_keywords" placeholder="Enter Meta Keywords" @if (!empty($category['meta_keywords'])) value="{{ $category['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
                  </div>
                  @error('meta_keywords')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <label for="meta_keywords">Featured Item</label>
                    <input type="checkbox" class="form-control @error('is_featured') is-invalid @enderror" name="is_featured" value="1" @if (@isset({{ $product['is_featured'] }})) {{ $product['is_featured'] }} @endif>
                  </div>
                  @error('is_featured')
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

