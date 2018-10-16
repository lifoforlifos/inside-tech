<?php

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/{any}', function () {
    return view('welcome');
})->where(['any' => '.*']);
