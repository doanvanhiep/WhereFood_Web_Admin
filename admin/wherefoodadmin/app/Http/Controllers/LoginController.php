<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $Account=$request->username;
        $HashPassWord=$request->password;
      
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/admin/loginadmin',
        ['form_params' => [
        'Account'=>$Account,
        'HashPassWord'=>$HashPassWord]]); 
        $user=json_decode($res->getBody());
        if(count((array)$user)>0)
        {
            $request->session()->put('Auth','admin');
            return redirect()->route('index'); 
        }else
        {
            $request->session()->put('Auth','');
            return redirect()->route('index'); 
        }
    }
}
