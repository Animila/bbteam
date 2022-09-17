<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Chapters\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        if ($new_chapter = $this->service->ChaptersStore($data)) {
            return [
                'status'=>true,
                'id_chapter'=>$new_chapter->id
            ];
        } else {
            return [
                'status'=> false,
                'error'=>'Ошибка создания'
            ];
        }
    }
}
