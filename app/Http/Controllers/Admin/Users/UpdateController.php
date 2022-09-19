<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request,User $user)
    {
        if (Gate::check('for_admin_user')){
            try {
                $data = $request->validated();
                $data['premium'] = $data['premium'] == 'true' ? true : false;
                $data['hide_18'] = $data['hide_18'] == 'true' ? true : false;
                $user->update($data);
            } catch (\Exception $e) {
                return [
                    'status'=>false,
                    'error'=>'Неизвестная ошибка. Обратитесь к администратору: '.$e
            ];
            }
            return [
                'status'=>true,
            ];


        } else {
            return back();
        }

    }
}
