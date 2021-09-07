<?php
function getStatus($status): string
{
    $all = ['Deactivated', 'Activated', 'Deleted'];
    return $all[$status] ?? '';
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
