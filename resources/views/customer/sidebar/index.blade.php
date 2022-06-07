<div class="card account-left">
    <div class="user-profile-header">
       <img alt="logo" src="{{ asset('site-template/img/default-avatar.png') }}">
       <h5 class="mb-1 text-secondary"><strong>Hi </strong> {{ Auth::user()->firstname }}</h5>
       <p>{{ Auth::user()->contact_no }}</p>
    </div>
    <div class="list-group">
        <a href="{{ route('redirect') }}" class="list-group-item list-group-item-action {{ Request::is('dashboard') ? 'active' : '' }}">
            <i aria-hidden="true" class="mdi mdi-account-outline"></i> My Profile
        </a>
        <a href="{{ route('my-address.index') }}" class="list-group-item list-group-item-action {{ Request::is('customer/my-address*') ? 'active' : '' }}">
            <i aria-hidden="true" class="mdi mdi-map-marker-circle"></i> My Address
        </a>
        <a href="{{ route('wishlist.index') }}" class="list-group-item list-group-item-action {{ Request::is('customer/wishlist*') ? 'active' : '' }}">
            <i aria-hidden="true" class="mdi mdi-heart-outline"></i> Wish List
        </a>
        <a href="{{ route('orderlist.index') }}" class="list-group-item list-group-item-action {{ Request::is('customer/orderlist*') ? 'active' : '' }}">
            <i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> Order List
        </a>
        <a 
            href="{{ route('logout') }}" 
            class="list-group-item list-group-item-action" 
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i aria-hidden="true" class="mdi mdi-lock"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

