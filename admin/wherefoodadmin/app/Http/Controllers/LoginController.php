<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost/WhereFood-API-Server/api/wherefood/public/api/admin/loginadmin', [
           /*  'form_params' => [
                '_token' => csrf_token(),
                'Account' => 'admin',
                'HashPassWord' => '12345678',
            ] */
        ]);
        //echo $res->getStatusCode();
        // 200
        //echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        echo $res->getBody();
        // {"type":"User"...'
    }
}
