<?php
namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //Function Main
    public function Main()
    {
        $client = new Client();
        $res = $client->request('GET', 'http://localhost/WhereFood-API-Server/api/wherefood/public/api/user/getalluser'); 
        $listuser=json_decode($res->getBody());
        return view('listuser',['listuser'=>(array)$listuser]);
    }
}
