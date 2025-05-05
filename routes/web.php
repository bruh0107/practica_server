<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login'])->middleware('guest');
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/add-employee', [Controller\Site::class, 'addEmployee'])->middleware('auth', 'admin');
Route::add('GET', '/add-doctor', [Controller\Site::class, 'addDoctor'])->middleware('auth', 'employee');
Route::add('GET', '/add-patient', [Controller\Site::class, 'addPatient'])->middleware('auth', 'employee');
Route::add('GET', '/create-entry', [Controller\Site::class, 'createEntry'])->middleware('auth', 'employee');
Route::add('GET', '/entries', [Controller\Site::class, 'entries'])->middleware('auth');