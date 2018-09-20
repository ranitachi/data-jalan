<?php

Route::resource('user-management', 'Api\ApiUserManagementController', [ 'except' => ['create', 'edit'] ]);

Route::resource('kat-berita-management', 'Api\ApiKatBeritaManagementController', [ 'except' => ['create', 'edit'] ]);
Route::resource('berita-management', 'Api\ApiBeritaManagementController', [ 'except' => ['create', 'edit'] ]);

Route::post('change-password', 'Api\ApiChangePasswordController');

Route::resource('usulan-api', 'Api\ApiUsulanController');

Route::resource('verified-api', 'Api\ApiVerifiedController', [ 'only' => ['index', 'show'] ]);

Route::get('dana-api/{id}', 'Api\ApiDanaController@byID');