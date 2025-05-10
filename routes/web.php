<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login'])->middleware('guest');
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/add-employee', [Controller\Site::class, 'addEmployee'])->middleware('auth', 'admin');
Route::add(['GET', 'POST'], '/add-doctor', [Controller\Site::class, 'addDoctor'])->middleware('auth', 'employee');
Route::add(['GET', 'POST'], '/add-patient', [Controller\Site::class, 'addPatient'])->middleware('auth', 'employee');
Route::add(['GET', 'POST'], '/create-entry', [Controller\Site::class, 'createEntry'])->middleware('auth', 'employee');
Route::add('GET', '/entries', [Controller\Site::class, 'getEntries'])->middleware('auth');
Route::add('GET', '/patients', [Controller\Site::class, 'getPatients'])->middleware('auth');
Route::add('GET', '/doctors', [Controller\Site::class, 'getDoctors'])->middleware('auth');
Route::add('GET', '/doctors/{id}', [Controller\Site::class, 'getDoctorById'])->middleware('auth');
Route::add('GET', '/patients/{id}', [Controller\Site::class, 'getPatientById'])->middleware('auth');
Route::add('GET', '/entries/{id}/cancel', [Controller\Site::class, 'cancelEntry'])->middleware('auth', 'employee');