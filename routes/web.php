<?php

use App\Controllers\IndexController;
use Kernel\Router\Route;

return [
	Route::get('/', [IndexController::class, 'index'])
];
