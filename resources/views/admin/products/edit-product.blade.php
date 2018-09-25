@extends('layouts.adminLayout.admin_design')

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Product</a> </div>
            <h1>Admin Products</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span8">
                    @include('inc.messages')
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit Product</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/edit-product/' .$product->id)}}" name="edit_product" id="edit_product" novalidate="novalidate">
                                @csrf
                                <div class="control-group">
                                    <label class="control-label">Under Category</label>
                                    <div class="controls">
                                        <select name="category_id" id="category_id" style="width: 220px">
                                            <?php echo $categories_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <div class="controls">
                                        <input type="text" name="product_name" id="product_name" value="{{$product->product_name}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code</label>
                                    <div class="controls">
                                        <input type="text" name="product_code" id="product_code" value="{{$product->product_code}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Color</label>
                                    <div class="controls">
                                        <input type="text" name="product_color" id="product_color" value="{{$product->product_color}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description">{{$product->description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Material & Care</label>
                                    <div class="controls">
                                        <textarea name="care" id="care">{{$product->care}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Price</label>
                                    <div class="controls">
                                        <input type="text" name="price" id="price" value="{{$product->price}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image</label>
                                    <div class="controls">
                                        <input type="file" name="image" id="image">
                                        <input type="hidden" name="current_image" value="{{$product->image}}">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit Product" class="btn btn-success">
                                    <a class="btn btn-warning" href="{{url('/admin/view-products')}}">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    @if(!empty($product->image))
                        <img src="{{asset('/images/backend_images/products/medium/'.$product->image)}}" class="img-polaroid">
                        <a id="delImage" style="margin: 30px 0" class="btn btn-danger btn-large" href="{{url('/admin/delete-product-image/'.$product->id)}}">Delete</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection