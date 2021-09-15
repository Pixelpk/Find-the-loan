<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CompanyStructureController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FinancePartnerController;
use App\Http\Controllers\Admin\LoanReasonController;
use App\Http\Controllers\Admin\LoanTypeController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController as ControllersUserController;
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
//CMS routes
Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('faqs',[HomeController::class,'faqs'])->name('faqs');
Route::get('our-blogs',[HomeController::class,'blogs'])->name('our-blogs');
Route::get('blog',[HomeController::class,'blogDetail'])->name('blog');
Route::get('about-us',[HomeController::class,'aboutUs'])->name('about-us');
Route::get('privacy-policy',[HomeController::class,'privacyPolicy'])->name('privacy-policy');
Route::get('contact-us',[HomeController::class,'contactUs'])->name('contact-us');
Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'loginAttempt'])->name('loginAttempt');
Route::get('registration',[RegistrationController::class,'index'])->name('registration');
Route::post('registration',[RegistrationController::class,'store'])->name('registrationStore');
Route::get('verify',[RegistrationController::class,'verifyEmail'])->name('verifyEmail');

// Admin routes
Route::get('admin-login', [UserController::class,'adminLogin'])->name('admin-login');
Route::post('/admin-login', [UserController::class,'login'])->name('admin-login');
Route::group(['middleware'=>['auth:partners','partner']],function (){
//    Route::get('/admin-dashboard', [UserController::class,'dashboard'])->name('admin-dashboard');

});
Route::group(['middleware'=>['auth:users,partners']],function (){
    Route::get('/site-data', [SiteController::class,'siteData'])->name('site-data');
    Route::post('/submit-site-data', [SiteController::class,'submitSiteData'])->name('submit-site-data');

    Route::get('/users', [UserController::class,'users'])->name('users');
    Route::get('/active-user', [UserController::class,'todayActiveUser'])->name('active-user');
    Route::get('/admin-profile', [UserController::class,'profile'])->name('admin-profile');
    Route::post('update-admin', [UserController::class,'updateAdminProfile'])->name('update-admin');
    Route::post('user-detail', [UserController::class,'userDetail'])->name('user-detail');
    Route::post('update-user', [UserController::class,'updateUser'])->name('update-user');
    Route::post('update-password', [UserController::class,'updatePassword'])->name('update-password');
    Route::get('change-user-status', [UserController::class,'changeStatus'])->name('change-user-status');
   
    Route::get('/admin-dashboard', [UserController::class,'dashboard'])->name('admin-dashboard');
    Route::get('/profile', [UserController::class,'profile'])->name('profile');
    Route::post('update-password', [UserController::class,'updatePassword'])->name('update-password');
    // Route::get('/logout', [UserController::class,'logout'])->name('admin-logout');

    Route::get('/approval-requests', [UserController::class,'approvalRequests'])->name('approval-requests');
    Route::get('/approve-user', [UserController::class,'approveUser'])->name('approve-user');

    Route::get('/faq', [FaqController::class,'faq'])->name('faq');
    Route::post('add-faq', [FaqController::class,'addFaq'])->name('add-faq');
    Route::post('faq-detail', [FaqController::class,'faqDetail'])->name('faq-detail');
    Route::get('change-faq-status', [FaqController::class,'changeStatus'])->name('change-faq-status');

    Route::get('/blogs', [BlogController::class,'blogs'])->name('blogs');
    Route::post('add-blog', [BlogController::class,'addBlog'])->name('add-blog');
    Route::post('blog-detail', [BlogController::class,'blogDetail'])->name('blog-detail');
    Route::get('change-blog-status', [BlogController::class,'changeStatus'])->name('change-blog-status');

    Route::get('/testimonials', [TestimonialController::class,'testimonials'])->name('testimonials');
    Route::post('add-testimonial', [TestimonialController::class,'addTestimonial'])->name('add-testimonial');
    Route::post('testimonial-detail', [TestimonialController::class,'testimonialDetail'])->name('testimonial-detail');
    Route::get('change-testimonial-status', [TestimonialController::class,'changeStatus'])->name('change-testimonial-status');

    Route::get('/finance-partners', [FinancePartnerController::class,'financePartners'])->name('finance-partners');
    Route::post('add-partner', [FinancePartnerController::class,'addPartner'])->name('add-partner');
    Route::post('update-partner', [FinancePartnerController::class,'updatePartner'])->name('update-partner');
    Route::post('partner-detail', [FinancePartnerController::class,'partnerDetail'])->name('partner-detail');
    Route::get('change-partner-status', [FinancePartnerController::class,'changeStatus'])->name('change-partner-status');

    Route::get('/loan-types', [LoanTypeController::class,'loanTypes'])->name('loan-types');
    Route::post('add-loan-type', [LoanTypeController::class,'addLoanType'])->name('add-loan-type');
    Route::post('loan-type-detail', [LoanTypeController::class,'loanTypeDetail'])->name('loan-type-detail');
    Route::get('loan-type-status', [LoanTypeController::class,'changeStatus'])->name('loan-type-status');

    Route::get('/loan-subtypes', [LoanTypeController::class,'loanSubTypes'])->name('loan-subtypes');
    Route::post('add-loan-subtype', [LoanTypeController::class,'addLoanSubType'])->name('add-loan-subtype');

    Route::get('/loan-reasons', [LoanReasonController::class,'loanReasons'])->name('loan-reasons');
    Route::get('/get-loan-type/{id}', [LoanReasonController::class,'getLoanType'])->name('get-loan-type');
    Route::post('add-loan-reason', [LoanReasonController::class,'addReason'])->name('add-loan-reason');
    Route::post('loan-reason-detail', [LoanReasonController::class,'reasonDetail'])->name('loan-reason-detail');
    Route::get('loan-reason-status', [LoanReasonController::class,'changeStatus'])->name('loan-reason-status');

    Route::get('/company-structure-type', [CompanyStructureController::class,'structureTypes'])->name('company-structure-type');
    Route::post('add-company-structure', [CompanyStructureController::class,'addType'])->name('add-company-structure');
    Route::post('company-structure-detail', [CompanyStructureController::class,'typeDetail'])->name('company-structure-detail');
    Route::get('company-structure-status', [CompanyStructureController::class,'changeStatus'])->name('company-structure-status');

    Route::get('/sectors', [SectorController::class,'sectors'])->name('sectors');
    Route::post('add-sector', [SectorController::class,'addSector'])->name('add-sector');
    Route::post('sector-detail', [SectorController::class,'sectorDetail'])->name('sector-detail');
    Route::get('sector-status', [SectorController::class,'changeStatus'])->name('sector-status');
    Route::get('/logout', [UserController::class,'logout'])->name('admin-logout');


});



Route::group(['middleware'=>['customer']],function (){
    Route::get('/customer-dashboard', [ControllersUserController::class,'dashboard'])->name('customer-dashboard');
});
