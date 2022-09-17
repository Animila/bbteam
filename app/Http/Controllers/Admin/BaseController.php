<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BaseController extends Controller
{
    public $service;
    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }
}
