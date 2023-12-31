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

 

if(!function_exists('order_page_number'))
{
    function order_page_number($currentPage, $perPage)
    {
        if (is_null($currentPage)) {
            $nomor = 1;
        } else {
            $nomor = 1 + ($perPage * ($currentPage - 1));
        }
        return $nomor;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        // Protocol
		$config['protocol'] = getenv('email_config_protocol');
		// Host
		$config['SMTPHost'] = getenv('email_config_SMTPHost');
		// Port
		$config['SMTPPort'] = getenv('email_config_SMTPPort');
		// User
		$config['SMTPUser'] = getenv('email_config_SMTPUser');
		// Pass
		$config['SMTPPass'] = getenv('email_config_SMTPPass');
		
		return $config;
    }
}

 
 
