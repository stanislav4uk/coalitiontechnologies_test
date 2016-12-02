<?php

Route::get('products/{product_id}/edit', 'ProductController@edit')->name('products.edit');

Route::resource('products', 'ProductController', ['except' => ['show', 'delete', 'edit']]);

Route::get('products/content', 'ProductController@table')->name('products.content');

