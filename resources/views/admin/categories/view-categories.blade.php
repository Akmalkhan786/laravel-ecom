@extends('layouts.adminLayout.admin_design')

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Categories</a> </div>
            <h1>Admin Categories
                <a class="btn btn-primary pull-right margin-for-add-button" href="{{url('/admin/add-category')}}"><i class="icon-plus-sign"></i> Add Category</a>
            </h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    @include('inc.messages')
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                            <h5>Categories</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped data-table">
                                @if(count($categories) > 0)
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category Level</th>
                                        <th>Status</th>
                                        <th>Url</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $key=>$category)
                                        <tr class="odd gradeX">
                                            <td>{{$key + 1}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                @if($category->parent_id == 0)
                                                    <p>Have no parent category</p>
                                                @else
                                                    {{$category->parent_id}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($category->status == 1)
                                                    <span class="badge badge-success">Enable</span>
                                                @else
                                                    <span class="badge badge-important">Disable</span>
                                                @endif
                                            </td>
                                            <td>{{$category->url}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-mini" href="{{url('/admin/edit-category/' . $category->id)}}"><i class="icon-edit"></i> Edit</a>
                                                <a id="delCat" class="btn btn-danger btn-mini" href="{{url('/admin/delete-category/' . $category->id)}}"><i class="icon-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                    <p class="label label-important not-found-style">There is no category to show</p>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection