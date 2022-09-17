<?php

namespace App\Http\Controllers\Admin\Titles;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Titles\StoreRequest;
use App\Http\Requests\Admin\Titles\UpdateRequest;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request)
    {
        return redirect()->route('titles.edit', $this->service->TitlesUpdate($request->validated()));
    }
}
