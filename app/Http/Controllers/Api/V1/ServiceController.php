<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Google\Client;


class ServiceController extends Controller
{
    public const GOOGLE_SCOPES=[
        "https://www.googleapis.com/auth/drive",
        "https://www.googleapis.com/auth/drive.file"
    ];
    public function connect(Request $request)
    {
        if ($request->service == 'google-drive') {

            $client = new Client();
            $config=config('services.google');
            $client->setClientId($config['id']);
            $client->setClientSecret($config['secret']);
            $client->setRedirectUri($config['uri']);
            $client->addScope(self::GOOGLE_SCOPES);
            $url = $client->createAuthUrl();
            return response(['url'=>$url]);
        }
    }
    public function callback(Request $request)
    {
        $client = app(Client::class);
        $config=config('services.google');
        $client->setClientId($config['id']);
        $client->setClientSecret($config['secret']);
        $client->setRedirectUri($config['uri']);
        $code = request('code');
        $access_token = $client->fetchAccessTokenWithAuthCode($code);
        $service=Service::create([
            'name'=>'google-drive',
            'token'=>json_encode(['access_token'=>$access_token]),
            'user_id'=>auth()->user()->id
        ]);
        return $service;
    }
}
