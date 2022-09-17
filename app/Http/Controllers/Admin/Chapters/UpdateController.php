<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Chapters\UpdateRequest;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request)
    {
        return redirect()->route('chapter.edit', $this->service->ChaptersUpdate($request->validated()));
    }
}
