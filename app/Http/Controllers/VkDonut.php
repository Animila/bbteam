<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use Illuminate\Http\Request;

class VkDonut extends Controller
{
    public function __invoke()
    {
        $url = 'https://api.vk.com/method/donut.getSubscription';
        $data['owner_id'] = '-209486534';
        $data['access_token'] = SocialAccount::where('user_id', auth()->id())->get()->first()->token;
        $data['v'] = 5.131;

        $requestParams = http_build_query($data);

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
                'content' => $requestParams,
            ),
        ));

        $result = json_decode(file_get_contents($url, false, $context), true);

        if (isset($result['error'])) {
            dd('есть ли');
            return back();
        }
        auth()->user()->update([
            'premium'=> $result['response']['status'] == 'active',
        ]);
        return redirect()->route('account.index');
    }
}
