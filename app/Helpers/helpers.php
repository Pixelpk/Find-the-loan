<?php

use App\Models\FinancePartner;
use Illuminate\Support\Facades\Auth;

function getStatus($status): string
{
    $all = ['Deactivated', 'Activated', 'Deleted'];
    return $all[$status] ?? '';
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
        'our-blogs'=>"Blogs",
        'blog'=>"Blogs",
        'faqs'=>"Faqs",
        'terms-conditions'=>"Terms of uses",
        'privacy-policy'=>"Privacy policy",
        'contact-us'=>"Contact",
        'financial-inclusion'=>"Financial Inclusion",
        'glossary'=>"Glossary",
    ];
    return $all[$route_name] ?? '';
}

function moreDocReasons(): array
{
    $all = ['', 'Incomplete', 'Incorrect','Unclear','In PDF','Requires supporting document','Due to quantum','Due to risk profile','Due to age','Of main applicant/s','Of all shareholders','For TDSR/DSR purpose','Need Exercised'];
    return $all;
}

function moreDocOfList()
{
    $all = ['', 'Of company', 'Of Parent Company','Of all companies in the group','Of  all Local director','Of Ultimate Beneficial Owner','Of  guarantor','Of mortgagor','Of all property/asset owner','Of new property','Of property sold','Of current property','Personal/company info not shown/Unable to correctly identify as belonging to'];
    return $all;
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

