<?php

use Illuminate\Support\Facades\Route;
use Interfaces\Http\Plans\Controllers\PlanController;

Route::get('admin/plans', [PlanController::class, 'index']);
