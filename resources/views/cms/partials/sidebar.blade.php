<?php 
    $totalPendingOrders = \App\Models\Order::whereOrderStatusId(1)->count();
?>

<ul id="nav">
    <li class="{{ Request::is('/') ? 'current' : '' }}">
        <a href="{{ route('redirect') }}">
            <i class="icon-home"></i>
            Dashboard
        </a>
    </li>
    <li class="{{ Request::is('cms/website*') ? 'current' : '' }}">
        <a href="#!">
            <i class="icon-sitemap"></i>
            Website
        </a>
        <ul class="sub-menu">
            {{-- <li class="{{ Request::is('programs-and-courses/degree*') ? 'current' : '' }}">
                <a href="#!">
                    Site Settings*
                </a>
            </li>
            <li class="{{ Request::is('programs-and-courses/degree*') ? 'current' : '' }}">
                <a href="#!">
                    Delivery Fees*
                </a>
            </li> --}}
            <li class="{{ Request::is('cms/website/homepage-sliders*') ? 'current' : '' }}">
                <a href="{{ route('homepage-sliders.index') }}">
                    Homepage Sliders
                </a>
            </li>
            <li class="{{ Request::is('cms/website/members*') ? 'current' : '' }}">
                <a href="{{ route('members.index') }}">
                    Members
                </a>
            </li>
        </ul>
    </li>
    <li class="{{ Request::is('cms/manage-products*') ? 'current' : '' }}">
        <a href="#!">
            <i class="icon-food"></i>
            Manage Products
        </a>
        <ul class="sub-menu">
            <li class="{{ Request::is('cms/manage-products/categories*') ? 'current' : '' }}">
                <a href="{{ route('categories.index') }}">
                    Categories
                </a>
            </li>
            <li class="{{ Request::is('cms/manage-products/products*') ? 'current' : '' }}">
                <a href="{{ route('products.index') }}">
                    Products
                </a>
            </li>
        </ul>
    </li>
    <li class="{{ Request::is('cms/manage-orders/orders*') ? 'current' : '' }}">
        <a href="{{ route('orders.index') }}">
            <i class="icon-shopping-cart"></i>
            Manage Orders 
            @if($totalPendingOrders > 0)
                <span class="label label-info pull-right">{{ $totalPendingOrders }}</span>
            @endif
        </a>
    </li>
</ul>