@extends('layouts.adminLayout.admin_design')

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Add Product Images</a> </div>
            <h1>Product Images</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    @include('inc.messages')
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Product Images</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-images/'. $product->id)}}" name="add_attribute" id="add_attribute">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <label class="control-label"><strong>{{$product->product_name}}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code</label>
                                    <label class="control-label"><strong>{{$product->product_code}}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Alternate Image(s)</label>
                                    <div class="controls">
                                        <input type="file" name="image[]" id="image" multiple="multiple">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Images" class="btn btn-success">
                                    <a class="btn btn-warning" href="{{url('/admin/view-products')}}">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>View Images</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped data-table">
                                @if(count($productImages) > 0)
                                    <thead>
                                    <tr>
                                        <th>Image Id</th>
                                        <th>Product Id</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productImages as $image)
                                            <tr>
                                                <td>{{$image->id}}</td>
                                                <td>{{$image->product_id}}</td>
                                                <td>
                                                    <img src="{{asset('/images/backend_images/products/small/alternateImages/'. $image->image)}}" width="80">
                                                </td>
                                                <td>
                                                    <a id="delAltProImages" class="btn btn-danger btn-mini" href="{{url('/admin/delete-alternate-images/'. $image->id)}}"><i class="icon-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <p class="label label-important not-found-style">There is no alternate images to show</p>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection