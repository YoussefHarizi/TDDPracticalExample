<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        return User::create(array_merge(Arr::except($request->validated(), 'password'), [ 'password' => Hash::make($request->password) ]));
    }

    public function login(Request $request)
    {
        $data=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user=User::whereEmail($data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password)){
            return response([
                'message'=>'bad credientiels'
            ],Response::HTTP_UNAUTHORIZED);
        }
     

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response);


    }
}
