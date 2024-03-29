<?php

use Src\Route;

Route::add(['GET', 'POST'], '/', [Controller\Site::class, 'admin'])   ->middleware('auth');
Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
   ->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

Route::add(['GET', 'POST'], '/abonents', [Controller\Site::class, 'abonents'])   ->middleware('auth');
Route::add(['GET', 'POST'], '/numbers', [Controller\Site::class, 'numbers'])   ->middleware('auth');
Route::add(['GET', 'POST'], '/rooms', [Controller\Site::class, 'rooms'])   ->middleware('auth');
Route::add(['GET', 'POST'], '/subdivisions', [Controller\Site::class, 'subdivisions'])   ->middleware('auth');

Route::add(['GET', 'POST'], '/createabonent', [Controller\Site::class, 'createabonent'])   ->middleware('auth');
Route::add(['GET', 'POST'], '/createnumber', [Controller\Site::class, 'createnumber'])   ->middleware('auth');
Route::add(['GET', 'POST'], '/createsubdivision', [Controller\Site::class, 'createsubdivision'])   ->middleware('auth');
Route::add(['GET', 'POST'], '/createroom', [Controller\Site::class, 'createroom']) ;


Route::add(['GET', 'POST'], '/addnumbertouser', [Controller\Site::class, 'addnumbertouser'])   ->middleware('auth');

