<?php

namespace App\Http\Controllers\Admin\Titles;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Titles\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->TitlesStore($data);
        return redirect()->route('titles');
    }
}
