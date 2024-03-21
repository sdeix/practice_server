<?php

use Src\Route;

Route::add('GET', '/', [Controller\Api::class, 'index']);
Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add('GET', '/subdivisions', [Controller\Api::class, 'subdivisions']);
Route::add('GET', '/abonents', [Controller\Api::class, 'abonents']);
Route::add('POST', '/addabonent', [Controller\Api::class, 'addabonent']);

