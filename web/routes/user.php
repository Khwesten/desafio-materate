<?php

Route::get('/edit/{id}', 'UserController@editView')->middleware('web');

Route::post('/edit/{id}', 'UserController@editDetails')->middleware('web');

Route::get('/remove/{id}', 'UserController@removeUser')->middleware('web');

Route::get('/removed', 'UserController@removedView')->middleware('web');

header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );

Route::post('/login', 'UserController@login');

Route::post('/logout/{id}', 'UserController@logout');

Route::get('/sessions/{id}', 'UserController@sessions');

Route::post('/register', 'UserController@register');

Route::put('/edit/{id}', 'UserController@edit');