<?php

 
// app/Controllers/MyController.php
namespace App\Controllers;

use App\Services\MyService;

class MyController extends BaseController {
    protected $myService;

    public function __construct(MyService $myService) {
        $this->myService = $myService;
    }

    public function index() {
        $data['result'] = $this->myService->doSomething();
        return view('my_view', $data);
    }
}
