<?php

use App\Models\FinancePartner;
use Illuminate\Support\Facades\Auth;

function getStatus($status): string
{
    $all = ['Deactivated', 'Activated', 'Deleted'];
    return $all[$status] ?? '';
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
    return ['', 'Super Admin', 'User','Chaperone support','Latina support','Revert support','Ask an Expert'];
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

