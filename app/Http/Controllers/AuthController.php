<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
        public function checkUserLevel(){
            if($res->rcode == 0){
                return redirect()->to('/');
            }
            else{
                return redirect()->to('/login');
            }
}