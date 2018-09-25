@extends('layouts.adminLayout.admin_design')

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Products</a> </div>
            <h1>Admin Products
                <a class="btn btn-primary pull-right margin-for-add-button" href="{{url('/admin/add-product')}}"><i class="icon-plus-sign"></i> Add Product</a>
            </h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    @include('inc.messages')
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                            <h5>Products</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped data-table">
                                @if(count($products) > 0)
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Id</th>
                                        <th>Category Name</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Color</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key=>$product)
                                        <tr class="odd gradeX">
                                            <td>{{$key + 1}}</td>
                                            <td>{{$product->category_id}}</td>
                                            <td>{{$product->category_name}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->product_code}}</td>
                                            <td>{{$product->product_color}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>
                                                @if(!empty($product->image))
                                                    <img src="{{asset('/images/backend_images/products/small/'.$product->image)}}" width="80">
                                                @else
                                                    <p class="label label-important">No image</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-mini tip-left" data-original-title="View Product" href="#myModal-{{$product->id}}" data-toggle="modal" ><i class="icon-eye-open"></i> View</a>
                                                <a class="btn btn-warning btn-mini tip-bottom" data-original-title="Add Product Attribute" href="{{url('/admin/add-attributes/'. $product->id)}}"><i class="icon-plus-sign"></i> Add</a>
                                                <a class="btn btn-info btn-mini tip-top" data-original-title="Add Product Images" href="{{url('/admin/add-images/'. $product->id)}}"><i class="icon-plus-sign"></i> Add</a>
                                                <a class="btn btn-primary btn-mini tip-bottom" data-original-title="Edit Product" href="{{url('/admin/edit-product/' . $product->id)}}"><i class="icon-edit"></i> Edit</a>
                                                <a id="delProduct" class="btn btn-danger btn-mini tip-right" data-original-title="Delete Product"  href="{{url('/admin/delete-product/' . $product->id)}}"><i class="icon-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                        <div id="myModal-{{$product->id}}" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>{{$product->product_name}} Full Details</h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>Product Id : {{$product->id}}</p>
                                                <p>Category Id : {{$product->category_id}}</p>
                                                <p>Category Name : {{$product->category_name}}</p>
                                                <p>Product Code : {{$product->product_code}}</p>
                                                <p>Product Color : {{$product->product_color}}</p>
                                                <p>Product Price : {{$product->price}}</p>
                                                <p>Fabric : </p>
                                                <p>Material : {{$product->care}}</p>
                                                <p>Description : {{$product->description}}</p>
                                                <p>Created At : {{$product->created_at ? $product->created_at->diffForHumans(): 'No date'}}</p>
                                                <p>Updated At : {{$product->updated_at ? $product->updated_at->diffForHumans(): 'No date'}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                @else
                                    <p class="label label-important not-found-style">There is no product to show</p>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection