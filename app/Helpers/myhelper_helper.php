<?php

use App\Models\AuditlogModel;

if (!function_exists('numbering')) {
    function numbering($currentPage, $perPage)
    {
        if (is_null($currentPage)) {
            $numbering = 1;
        } else {
            $numbering = 1 + ($perPage * ($currentPage - 1));
        }
        return $numbering;
    }
}


if (!function_exists('auditlog')) {
    function auditlog($action_made)
    {
        $AuditlogModel = new AuditlogModel();
        $data = [
            'name' => session('name'),
            'action_made'  => $action_made 
            
        ];
        $AuditlogModel->save($data);
    }
}

 
