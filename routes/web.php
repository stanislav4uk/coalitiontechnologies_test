<?php

Route::resource('products', 'ProductController', ['except' => ['show', 'delete']]);
