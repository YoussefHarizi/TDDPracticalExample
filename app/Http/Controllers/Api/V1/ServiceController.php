<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
}
