<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.home');
Route::post('/contact', [PortfolioController::class, 'sendContact'])->name('contact.send');
