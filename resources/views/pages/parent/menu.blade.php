{{--My Children--}}
<li class="nav-item">
    <a href="{{ route('my_children') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_children']) ? 'active' : '' }}"><i class="icon-users4"></i> My Children</a>
</li>

<li class="nav-item">
    <a href="{{ route('parent.permissions') }}" class="nav-link"><i class="icon-users4"></i>Permission</a>
</li>

{{-- <li class="nav-item">
    <a href="{{ route('my_children') }}" class="nav-link"><i class="icon-users4"></i>Permission</a>
</li> --}}