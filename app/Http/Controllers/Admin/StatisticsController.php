<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StatisticsController extends Controller
{
    public function __invoke()
    {
        if (Gate::check('for_admin_user')){
            $content = [
                'robots'=>'ALL, NOARCHIVE',
                'title_page'=>'Статистика',
                'description'=>'Сайт про мангу',
                'keywords' => 'Манга'.' Манхва'.' Читать'.' Маньхуа'
            ];
        return view('admin.statistic.index', compact('content'));
    } else {
        return back();
    }
    }
}
