<?php

use App\Http\Controllers\SmtpConfigurationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SmtpConfigurationController::class, 'smtp'])->name('smtp');
Route::get('email', [SmtpConfigurationController::class, 'sendEmailFrom'])->name('sendEmailFrom');
Route::post('smtp-configuration', [SmtpConfigurationController::class, 'save_configuration'])->name('save_smtp_configuration');
Route::post('send_email', [SmtpConfigurationController::class, 'send_email'])->name('send_email');
