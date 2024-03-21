<?php

use Src\Route;

Route::add('GET', '/', [Controller\Api::class, 'index']);
Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add('POST', '/rew', [Controller\Api::class, 'rew']);

