<?php

Breadcrumbs::for('shop', function ($trail) {
    $trail->push(__('shop::common.menu.home'));
});
Breadcrumbs::for('shop.categories.index', function ($trail) {
    $trail->push(__('shop::common.menu.category_management'), route('shop.categories.index'));
});
Breadcrumbs::for('shop.categories.create', function ($trail) {
    $trail->push(__('shop::common.menu.category_management'), route('shop.categories.create'));
});
Breadcrumbs::for('shop.categories.detail', function ($trail) {
    $trail->parent('shop.categories.index');
});
Breadcrumbs::for('shop.categories.children.create', function ($trail) {
    $trail->parent('shop.categories.index');
});
Breadcrumbs::for('shop.categories.children.edit', function ($trail) {
    $trail->parent('shop.categories.index');
});
Breadcrumbs::for('shop.users.index', function ($trail) {
    $trail->push(__('shop::common.menu.user_management'), route('shop.users.index'));
});
