@extends('admin.layout.layout')
@section('content')
   <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products Page</h1>
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
                  <h3 class="card-title">Products</h3>
                  {{-- @if ($productsmodule['edit_access']== 1 || $productsmodule['full_access']== 1) --}}
                  <a href="{{ url('admin/add-edit-product') }}" style="width: 150px; float:right; display:inline-block" class="btn btn-block btn-primary">Add Product</a>
                  {{-- @endif --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="products" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Product Code</th>
                      <th>Product Color</th>
                      <th>Category</th>
                      @if (@isset({{ $product['category']['parentcategory']['category_name'] }}))
                      <th>Parent Category</th>
                      @endif
                      <th>Created On</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $product['product_name'] }}</td>
                            <td>{{ $product['product_code'] }}</td>
                            <td>{{ $product['product_color'] }}</td>
                            <td>{{ $product['category']['category_name'] }}</td>
                            @if (@isset({{ $product['category']['parentcategory']['category_name'] }}))
                            <td>{{ $product['category']['parentcategory']['category_name'] }}</td>
                            @endif
                            <td>{{ date("F j, Y, g:i a", strtotime($product['created_at']))}}</td>
                            <td>
                                {{-- @if ($productsmodule['edit_access']== 1 || $productsmodule['full_access']== 1) --}}
                                @if ($product['status'] == 1)
                                <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                @else
                                <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive" style="color: gray"></i></a>
                                @endif
                                {{-- @endif --}}
                                &nbsp;&nbsp;
                                {{-- @if ($productsmodule['edit_access']== 1 || $productsmodule['full_access']== 1) --}}
                                <a class="editproduct" href="{{ url('admin/add-edit-product/'.$product['id']) }}" ><i class="fas fa-edit" aria-hidden="true"></i></a>
                                {{-- @endif --}}
                                &nbsp;&nbsp;
                                {{-- @if ($productsmodule['full_access']== 1) --}}
                                <a class="confirmDelete" title="Delete Product" href="javascript:void(0)" record="product" recordid="{{ $product['id'] }}"  {{--href="{{ url('admin/delete-cmspage/'.$page['id']) }}" --}}><i class="fa fa-trash" aria-hidden="true"></i></a>
                                {{-- @endif --}}
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
