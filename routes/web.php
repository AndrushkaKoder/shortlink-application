<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\IndexController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RedirectIfAuthMiddleware;
use Kernel\Router\Route;

return [
	Route::get('/', [IndexController::class, 'index'], [AuthMiddleware::class]),
	Route::get('/login', [LoginController::class, 'index'], [RedirectIfAuthMiddleware::class]),
	Route::post('/login', [LoginController::class, 'login']),
	Route::get('/register', [RegisterController::class, 'index'], [RedirectIfAuthMiddleware::class]),
	Route::post('/register', [RegisterController::class, 'register']),
	Route::post('/logout', [IndexController::class, 'logout'], [AuthMiddleware::class]),
	Route::post('/store', [IndexController::class, 'store']),
	Route::get('/get_links', [IndexController::class, 'getUserLinks']),
];
