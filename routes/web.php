<?php

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FinancePartnerController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

Route::get('admin-login', [UserController::class,'adminLogin'])->name('admin-login');
Route::post('/admin-login', [UserController::class,'login'])->name('admin-login');

Route::group(['middleware'=>['auth']],function (){
    Route::get('/users', [UserController::class,'users'])->name('users');
    Route::get('/active-user', [UserController::class,'todayActiveUser'])->name('active-user');
    Route::get('/admin-profile', [UserController::class,'profile'])->name('admin-profile');
    Route::post('update-admin', [UserController::class,'updateProfile'])->name('update-admin');
    Route::post('user-detail', [UserController::class,'userDetail'])->name('user-detail');
    Route::post('update-user', [UserController::class,'updateUser'])->name('update-user');
    Route::post('update-password', [UserController::class,'updatePassword'])->name('update-password');
    Route::get('change-user-status', [UserController::class,'changeStatus'])->name('change-user-status');
    Route::get('/logout', [UserController::class,'logout'])->name('admin-logout');
    Route::get('/admin-dashboard', [UserController::class,'dashboard'])->name('admin-dashboard');
    Route::get('/profile', [UserController::class,'profile'])->name('profile');
    Route::post('update-password', [UserController::class,'updatePassword'])->name('update-password');
    Route::get('/logout', [UserController::class,'logout'])->name('admin-logout');

    Route::get('/approval-requests', [UserController::class,'approvalRequests'])->name('approval-requests');
    Route::get('/approve-user', [UserController::class,'approveUser'])->name('approve-user');

    Route::get('/faq', [FaqController::class,'faq'])->name('faq');
    Route::post('add-faq', [FaqController::class,'addFaq'])->name('add-faq');
    Route::post('faq-detail', [FaqController::class,'faqDetail'])->name('faq-detail');
    Route::get('change-faq-status', [FaqController::class,'changeStatus'])->name('change-faq-status');

    Route::get('/finance-partners', [FinancePartnerController::class,'financePartners'])->name('finance-partners');
    Route::post('add-partner', [FinancePartnerController::class,'addPartner'])->name('add-partner');
    Route::post('partner-detail', [FinancePartnerController::class,'partnerDetail'])->name('partner-detail');
    Route::get('change-partner-status', [FinancePartnerController::class,'changeStatus'])->name('change-partner-status');

});
