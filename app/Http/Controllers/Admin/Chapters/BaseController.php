<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Http\Controllers\Controller;
use App\Service\Admin\ChapterService;

class BaseController extends Controller
{
    public $service;
    public function __construct(ChapterService $service)
    {
        $this->service = $service;
    }
}
