<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <h3>OƆ:CO</h3> 
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link  @if(\Request::is('admin/categories*')) c-active @endif" href="{{ route('admin.categories.index') }}">
            <i class="cil-list c-sidebar-nav-icon"></i>{{ __('admin::common.menu.category_management') }}</a>
        </li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link  @if(\Request::is('admin/shops*')) c-active @endif" href="{{ route('admin.shops.index') }}">
            <i class="cil-house c-sidebar-nav-icon"></i>{{ __('admin::common.menu.shop_management') }}</a>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
