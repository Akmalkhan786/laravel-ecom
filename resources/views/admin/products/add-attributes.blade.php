@extends('layouts.adminLayout.admin_design')

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Add Product Attributes</a> </div>
            <h1>Product Attributes</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    @include('inc.messages')
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Product Attributes</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-attributes/'. $product->id)}}" name="add_attribute" id="add_attribute">
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
                                    <label class="control-label">Product Color</label>
                                    <label class="control-label"><strong>{{$product->product_color}}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="field_wrapper">
                                        <div style="padding: 10px 0">
                                            <input required type="text" name="sku[]" placeholder="Sku" id="sku" class="add-remove-style">
                                            <input required type="text" name="size[]" placeholder="Size" id="size" class="add-remove-style">
                                            <input required type="text" name="price[]" placeholder="Price" id="price" class="add-remove-style">
                                            <input required type="text" name="stock[]" placeholder="Stock" id="stock" class="add-remove-style">
                                            <a href="javascript:void(0);" class="add_button" title="Add field"> Add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Attribute" class="btn btn-success">
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
                            <h5>View Attributes</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                @if(count($product['attributes']) > 0)
                                    <thead>
                                    <tr>
                                        <th>Attribute Id</th>
                                        <th>Sku</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product['attributes'] as $key=>$attribute)
                                        <tr class="odd gradeX">
                                            <td>{{$key + 1}}</td>
                                            <td>{{$attribute->sku}}</td>
                                            <td>{{$attribute->size}}</td>
                                            <td>{{$attribute->price}}</td>
                                            <td>{{$attribute->stock}}</td>
                                            <td>
                                                <a id="delProductAttribute" class="btn btn-danger btn-mini" href="{{url('/admin/delete-attribute/' . $attribute->id)}}"><i class="icon-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                    <p class="label label-important not-found-style">There is no attribute to show</p>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection