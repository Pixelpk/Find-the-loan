<?php

use App\Models\FinancePartner;
use App\Models\WebData;
use Illuminate\Support\Facades\Auth;

function getStatus($status): string
{
    $all = ['Deactivated', 'Activated', 'Deleted'];
    return $all[$status] ?? '';
}

function allReferenceRates(){
    return $all = [
        'SORA',
        'SIBOR',
        'SOFR',
        'LIBOR',
        'CORRA',
        'TONA',
        'SARON',
        'HIDB',
        'SOR',
        'BOARD',
        'AONIA',
        'THOR',
        'HONIA',
        'SONIA',
    ];
    
}

function getAdditionDocInfoType($type): string
{
    $all = ['', 'Company related', 'ACRA related','Project.Invoice/PO financing related','DCP and Secured overdraft related','Machinery/equipment/vehicle related','Individual related','Property related','Equipment/Vehicle related'];
    return $all[$type] ?? '';
}

function getCmsRoute($route_name): string
{
    $all = [
        'home'=>"Home",
        'about-us'=>"About",
        'all-blogs'=>"Blogs",
        'blog'=>"Blogs",
        'faqs'=>"Faqs",
        'terms-conditions'=>"Terms of use",
        'privacy-policy'=>"Privacy policy",
        'contact-us'=>"Contact",
        'financial-inclusion'=>"Financial Inclusion",
        'glossary'=>"Glossary",
        'apply-loan'=>"Apply loan",
    ];
    return $all[$route_name] ?? '';
}

function getFooterText()
{
    return WebData::where('key_name','=','footer_text')->select('value')->first()->value;
}

function moreDocReasons(): array
{
    $all = ['','Latest','Required Company stamp','Need notarized','Require Signature of borrower',"Require Signature of borrower's Customer", 'Incomplete', 'Incorrect','Unclear','In PDF','Requires supporting document','Due to quantum','Due to risk profile','Due to age','Of main applicant/s','Of all shareholders','For TDSR/DSR purpose','Need Exercised'];
    return $all;
}

function getMoreDocReason($id){
    $all = moreDocReasons();
    return $all[$id];
}

function moreDocOfList()
{
    $all = ['', 'Of company', 'Of Parent Company','Of all companies in the group','Of  all Local director','Of Ultimate Beneficial Owner','Of  guarantor','Of mortgagor','Of all property/asset owner','Of new property','Of property sold','Of current property','Personal/company info not shown/Unable to correctly identify as belonging to'];
    return $all;
}

function getDocumentOf($id){
    $all = moreDocOfList();
    return $all[$id];
}

function adminTermsRequests(){
    return FinancePartner::where('status','=','1')
        ->where('parent_id','=',0)
        ->where('terms_request_status','1')->count();
}

function bankUserTermsRequest(){
    $user = Auth::user();
    if ($user->parent_id == 0){
        if ($user->terms_request_status == 0){
            return 1;
        }
        return 0;
    }else{
        return 0;
    }
}

function getYesNo($status): string
{
    $all = ['No', 'Yes'];
    return $all[$status] ?? '';
}

function allRoles(): array
{
    return ['', 'Super Admin', 'User'];
}

function getRole($role): string
{
    $all = allRoles();
    return $all[$role] ?? '';
}


function loanProfile(): array
{
    return ['','Business', 'Consumer'];
}

function getProfile($type): string
{
    $all = loanProfile();
    return $all[$type] ?? '';
}

function getFixedFloating($type)
{
    $all = ['',"Fixed","Floating"];
    return $all[$type];
}

