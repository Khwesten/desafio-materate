<?php

//Route::post('/login', 'UserController@login');

Route::get('/edit/{id}', 'UserController@editView')->middleware('auth');

Route::post('/edit/{id}', 'UserController@editDetails')->middleware('auth');

Route::get('/remove/{id}', 'UserController@removeUser')->middleware('auth');

Route::get('/removed', 'UserController@removedView')->middleware('auth');