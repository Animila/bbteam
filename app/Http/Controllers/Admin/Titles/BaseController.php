<?php

namespace App\Http\Controllers\Admin\Titles;

use App\Http\Controllers\Controller;
use App\Service\Admin\TitlesService;

class BaseController extends Controller
{
    public $service;
    public function __construct(TitlesService $service)
    {
        $this->service = $service;
    }
}
