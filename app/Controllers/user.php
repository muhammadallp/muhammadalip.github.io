<?php

namespace App\Controllers;

class user extends BaseController
{
   
    public function __construct()
    {
        $this->session = session();
        // $this->session = session()->get('isLogin');
    }
    
    public function index() 
    {
        //cek apakah ada session bernama isLogin
        if(!$this->session->get('isLogin')){
            return redirect()->to('/auth/login');
        }
        
        $title=[
            'title' =>'Home| Gosip',
            
        ]; 
        return view('user/index',$title);
    }
}           