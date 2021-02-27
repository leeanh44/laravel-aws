<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <h3>OƆ:CO</h3>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link  @if(\Request::is('shop/categories*')) c-active @endif" href="{{ route('shop.categories.index') }}">
            <i class="cil-list c-sidebar-nav-icon"></i>{{ __('shop::common.menu.category_management') }}</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link  @if(\Request::is('shop/users*')) c-active @endif" href="{{ route('shop.users.index') }}">
            <i class="cil-people c-sidebar-nav-icon"></i>{{ __('shop::common.menu.user_management') }}</a>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
