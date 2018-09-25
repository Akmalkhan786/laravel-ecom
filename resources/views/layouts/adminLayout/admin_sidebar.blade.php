<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li class="active"><a href="{{route('admin.dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        <li class="submenu"> <a href="#"><i class="icon icon-folder-open"></i> <span>Categories</span> <span class="label label-important">2</span></a>
            <ul>
                <li><a href="{{url('/admin/view-categories')}}"><i class="icon-eye-open"></i> <span>View Categories</span></a></li>
                <li><a href="{{url('/admin/add-category')}}"><i class="icon-plus-sign"></i> <span>Add Category</span></a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-table"></i> <span>Products</span> <span class="label label-important">2</span></a>
            <ul>
                <li><a href="{{url('/admin/view-products')}}"><i class="icon-eye-open"></i> <span>View Products</span></a></li>
                <li><a href="{{url('/admin/add-product')}}"><i class="icon-plus-sign"></i> <span>Add Product</span></a></li>
            </ul>
        </li>
        <li> <a href="charts.html"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>
    </ul>
</div>
<!--sidebar-menu-->