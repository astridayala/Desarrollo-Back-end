<?php


use App\Http\Controllers\EmailPreviewController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;

Route::get('api/v1/email/preview', EmailPreviewController::class);

