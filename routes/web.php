<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);


Route::resource('users', UserController::class);


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


Route::get('/payment', [PaymentController::class, 'showPaymentForm']);
Route::post('/charge', [PaymentController::class, 'charge']);

Route::post('/webhook/stripe', [WebhookController::class, 'handleStripeWebhook']);
