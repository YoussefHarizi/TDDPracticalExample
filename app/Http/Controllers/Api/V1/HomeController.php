<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        return [
            'success'=>true,
            'message'=>__('message.welcome'),
            'data'=>[
                'version'=>'1.0',
                'language'=>app()->getLocale(),
                'support'=>'youssef.harizi@gmail.com'
            ]
        ];
    }
}
