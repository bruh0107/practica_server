<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login'])->middleware('guest');
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/add-employee', [Controller\Site::class, 'addEmployee'])->middleware('auth', 'admin');
