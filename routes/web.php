<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CompanyStructureController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FinancePartnerController;
use App\Http\Controllers\Admin\LoanApplications;
use App\Http\Controllers\Admin\LoanReasonController;
use App\Http\Controllers\Admin\LoanTypeController;
use App\Http\Controllers\Admin\OCRController;
use App\Http\Controllers\Admin\PartnerUserController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoanQuotationController;
use App\Http\Controllers\CommonController;
use App\Http\Livewire\Cms\AboutUs;
use App\Http\Livewire\Cms\FaqComponent;
use App\Http\Livewire\Cms\PrivacyPolicyComponent;
use App\Http\Livewire\Cms\TermsConditionsComponent;
use App\Http\Livewire\Cms\ApplyLoan;
use App\Http\Livewire\Cms\BlogComponent;
use App\Http\Livewire\Cms\BlogDetailComponent;
use App\Http\Livewire\Cms\ContactUs;
use App\Http\Livewire\Cms\Home;
use App\Http\Livewire\Cms\Login;
use App\Http\Livewire\Cms\RegisterComponent;
use App\Models\LoanCompanyDetail;
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

Route::get('staple-login',[OCRController::class,'login'])->name('staple-login');
Route::get('staple-create-group',[OCRController::class,'createGroup'])->name('staple-create-group');
Route::get('staple-create-queue',[OCRController::class,'createQueue'])->name('staple-create-queue');
Route::get('staple-bank-stat',[OCRController::class,'bankStatDocType'])->name('staple-bank-stat');
Route::get('clear-cache',function (){
   \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});
//CMS routes
// Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/',Home::class)->name('home');
Route::get('our-blogs',BlogComponent::class)->name('our-blogs');
Route::get('registration',RegisterComponent::class)->name('registration');
Route::get('verify',[CommonController::class,'verifyEmail'])->name('verifyEmail');
Route::get('faqs',FaqComponent::class)->name('faqs');
Route::get('privacy-policy',PrivacyPolicyComponent::class)->name('privacy-policy');
Route::get('terms-conditions',TermsConditionsComponent::class)->name('terms-conditions');
// Route::get('our-blogs',[HomeController::class,'blogs'])->name('our-blogs');
Route::get('blog',BlogDetailComponent::class)->name('blog');
Route::get('about-us',AboutUs::class)->name('about-us');
// Route::get('privacy-policy',[HomeController::class,'privacyPolicy'])->name('privacy-policy');
Route::get('contact-us',ContactUs::class)->name('contact-us');
// Route::get('terms-conditions',[HomeController::class,'termsConditions'])->name('terms-conditions');
//Route::post('contact-us',[HomeController::class,'contactUsSubmit'])->name('contact-us');
// Route::get('login',[Login::class])->name('login');
// Route::post('login',[LoginController::class,'loginAttempt'])->name('loginAttempt');
// Route::get('registration',[RegistrationController::class,'index'])->name('registration');
// Route::post('registration',[RegistrationController::class,'store'])->name('registrationStore');


// Admin routes
Route::get('admin-login', [UserController::class,'adminLogin'])->name('admin-login');
Route::post('/admin-login', [UserController::class,'login'])->name('admin-login');
Route::get('partner-login', [UserController::class,'partnerLogin'])->name('partner-login');
Route::post('/partner-login-submit', [UserController::class,'partnerLoginSubmit'])->name('partner-login-submit');
Route::group(['middleware'=>['auth:partners','partner']],function (){
//    Route::get('/admin-dashboard', [UserController::class,'dashboard'])->name('admin-dashboard');

});
Route::group(['middleware'=>['auth:users,partners']],function (){
    Route::group(['middleware'=>['admin']],function (){
        Route::get('/site-data', [SiteController::class,'siteData'])->name('site-data');
        Route::post('/submit-site-data', [SiteController::class,'submitSiteData'])->name('submit-site-data');

        Route::get('/admin-profile', [UserController::class,'adminProfile'])->name('admin-profile');
        Route::get('/users', [UserController::class,'users'])->name('users');
        Route::post('update-admin', [UserController::class,'updateAdminProfile'])->name('update-admin');
        Route::post('user-detail', [UserController::class,'userDetail'])->name('user-detail');
        Route::post('update-user', [UserController::class,'updateUser'])->name('update-user');
        Route::post('update-password', [UserController::class,'updatePassword'])->name('update-password');
        Route::get('change-user-status', [UserController::class,'changeStatus'])->name('change-user-status');

        // Route::get('/logout', [UserController::class,'logout'])->name('admin-logout');

//        Route::get('/approval-requests', [UserController::class,'approvalRequests'])->name('approval-requests');
//        Route::get('/approve-user', [UserController::class,'approveUser'])->name('approve-user');

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
        Route::get('conditions-approval-requests', [FinancePartnerController::class,'conditionsApprovalRequests'])->name('conditions-approval-requests');
        Route::get('approve-request', [FinancePartnerController::class,'approveTermsConditions'])->name('approve-request'); //by super admin

        Route::get('/loan-types', [LoanTypeController::class,'loanTypes'])->name('loan-types');
        Route::get('/get-main-type/{id}', [LoanTypeController::class,'getMainTypes'])->name('get-main-type');
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
    });

    Route::group(['middleware'=>['partner']],function (){
        Route::get('additional-doc-info', [OCRController::class,'additionDocInfo'])->name('additional-doc-info');
        Route::post('additional-doc-info', [OCRController::class,'addAdditionDocInfo']); 

        Route::get('/partner-profile', [UserController::class,'partnerProfile'])->name('partner-profile');
        Route::post('/partner-profile', [UserController::class,'updatePartnerProfile']);
        Route::get('partner-users',[PartnerUserController::class,'users'])->name('partner-users');
        Route::get('partner-terms-conditions',[PartnerUserController::class,'termsConditions'])->name('partner-terms-conditions');
        Route::post('add-partner-user',[PartnerUserController::class,'addUser'])->name('add-partner-user');
        Route::post('request-terms-conditions',[PartnerUserController::class,'requestTermsConditions'])->name('request-terms-conditions');
        Route::post('update-partner-user',[PartnerUserController::class,'updateUser'])->name('update-partner-user');
        Route::post('partner-user-detail',[PartnerUserController::class,'userDetail'])->name('partner-user-detail');
        Route::get('partner-user-status',[PartnerUserController::class,'changeStatus'])->name('partner-user-status');
        Route::get('approve-request-by-bank', [FinancePartnerController::class,'approveTermsConditionsByBank'])->name('approve-request-by-bank'); //by super admin
        Route::get('enquiry-color',[FinancePartnerController::class,'enquiryColor'])->name('enquiry-color');
        Route::post('submit-partner-meta',[FinancePartnerController::class,'submitPartnerMeta'])->name('submit-partner-meta');

        Route::get('loan-applications',[LoanApplications::class,'loanApplications'])->name('loan-applications');
        Route::get('put-quotation',[LoanApplications::class,'putQuotation'])->name('put-quotation');
        Route::get('download-loan-doc',[LoanApplications::class,'downloadLoanDoc'])->name('download-loan-doc');
        Route::post('assign-application',[LoanApplications::class,'assignApplication'])->name('assign-application');
        Route::post('application-search',[LoanApplications::class,'applicationSearch'])->name('application-search');
        Route::post('reject-application',[LoanApplications::class,'rejectLoanApplication'])->name('reject-application');
        Route::get('loan-application-summary',[LoanApplications::class,'applicationSummary'])->name('aloan-application-summary');
        Route::get('quoted-customer',[LoanQuotationController::class,'quotedCustomer'])->name('quoted-customer');
        Route::get('quote-all-loan',[LoanQuotationController::class,'quoteAllOtherLoan'])->name('quote-all-loan');
        Route::get('quote-property-land-loan',[LoanQuotationController::class,'quotePropertyLand'])->name('quote-property-land-loan');
        Route::post('submit-quotation',[LoanQuotationController::class,'submitQuotation'])->name('submit-quotation'); 

    }); 

    Route::get('/dashboard', [UserController::class,'dashboard'])->name('admin-dashboard');
//    Route::get('/profile', [UserController::class,'profile'])->name('profile');
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
    Route::get('/get-main-type/{id}', [LoanTypeController::class,'getMainTypes'])->name('get-main-type');
    Route::post('add-loan-type', [LoanTypeController::class,'addLoanType'])->name('add-loan-type');
    Route::post('loan-type-detail', [LoanTypeController::class,'loanTypeDetail'])->name('loan-type-detail');
    Route::get('loan-type-status', [LoanTypeController::class,'changeStatus'])->name('loan-type-status');

    Route::get('/loan-subtypes', [LoanTypeController::class,'loanSubTypes'])->name('loan-subtypes');
    Route::post('add-loan-subtype', [LoanTypeController::class,'addLoanSubType'])->name('add-loan-subtype');

    Route::get('/loan-reasons', [LoanReasonController::class,'loanReasons'])->name('loan-reasons');
    Route::get('/get-loan-types', [LoanReasonController::class,'getLoanType'])->name('get-loan-types');
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
    Route::get('/admin-logout', [UserController::class,'logout'])->name('admin-logout');


});


Route::get('/login', Login::class)->name('login');
Route::group(['middleware'=>['customer']],function (){
    Route::get('/apply-loan', ApplyLoan::class)->name('applyLoan');
    // Route::get('/apply-loan', [ControllersUserController::class,'applyLoan'])->name('applyLoan');
    // Route::post('/apply-loan', [UserLoanController::class,'applyLoanStore'])->name('apply-loan-store');
    // Route::post('/loan-reason', [ControllersUserController::class,'loanReason'])->name('loan-reason');
    // Route::post('/loan-amount', [ControllersUserController::class,'loanAmount'])->name('loan-amount');
    // Route::get('/get-loan-type/{id}', [LoanReasonController::class,'getLoanType'])->name('get-loan-type');
    // Route::post('/get-loan-main-type', [LoanReasonController::class,'getLoanMainType'])->name('get-loan-main-type');
     Route::get('/logout', [UserController::class,'customerLogout'])->name('customer-logout');
    //  Route::post('/loan-share-holder-store', [UserLoanController::class,'shareHolderStore'])->name('loan-share-holder-store');
    //  Route::post('/get-share-holder-screen', [UserLoanController::class,'shareHolderScreen'])->name('get-share-holder-screen');
    //  Route::get('/company-share-holder/{apply_loan_id}/{index}', [UserLoanController::class,'CompanyShareHolder'])->name('company-share-holder');

});
Route::get('test', function (){
    $date = "10-10-2021";
    $day = "30";
    $cout = date('Y-m-d', strtotime($date. ' - 30 day'));
    // return $cout;
    $currentDate = date('Y-m-d');
    
});
