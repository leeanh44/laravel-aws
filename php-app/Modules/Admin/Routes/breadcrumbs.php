<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('admin::common.menu.home'));
});

// Master categories
Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->push(__('admin::common.menu.category_management'), route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push(__('admin::category.add'));
});

Breadcrumbs::for('admin.categories.edit', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push(__('admin::category.edit'));
});
Breadcrumbs::for('admin.shops.index', function ($trail) {
    $trail->push(__('admin::common.menu.shop_management'), route('admin.shops.index'));
});
Breadcrumbs::for('admin.shops.create', function ($trail) {
    $trail->parent('admin.shops.index');
    $trail->push(__('admin::shop.add'));
});
Breadcrumbs::for('admin.shops.edit', function ($trail) {
    $trail->parent('admin.shops.index');
    $trail->push(__('admin::shop.edit'));
});
