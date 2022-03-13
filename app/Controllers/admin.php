<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\pembayaranModel;
class admin extends BaseController
{
    
    protected $userModal;
    // protected $pembayaranModal;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->pembayaranModel = new pembayaranModel();
        // $this->session = session();
        // $this->session = session()->get('isLogin');
        $this->session = \Config\Services::session();
    }
    
    public function index()
    {
        //cek apakah ada session bernama isLogin

        if(!$this->session->get('isLogin')){
            return redirect()->to('/auth/login');
        }
        
        //cek role dari session
        if($this->session->get('role') != 1){
            return redirect()->to('/user');
        }
        $user= $this->userModel->findAll();
        $pembayaran= $this->pembayaranModel->findAll();
        $title=[
            'title' =>'Home | Gosip',
            'user' =>$user,
            'pembayaran'=>$pembayaran
        ];       
        return view('admin/index',$title);
        
    }

    public function datauser()
    {

        
        if(!$this->session->get('isLogin')){
            return redirect()->to('/admin');
        }
        if($this->session->get('role') != 1){
            return redirect()->to('/user');
        }

        $user= $this->userModel->findAll();
        $title=[
            'title' =>'datauser | Gosip',
            'user' =>$user
        ];
        //menampilkan halaman login
        return view('admin/datauser',$title);
    }
    

    public function delete($id)
    {
        if(!$this->session->get('isLogin')){
            return redirect()->to('/admin');
        }
        if($this->session->get('role') != 1){
            return redirect()->to('/user');
        }

         $this->userModel->delete($id);

        session()->setFlashdata('pesan','<div class="alert alert-success" role="alert">
        Data Berhasil Di Hapus!
      </div>');

        return redirect()->to('admin/datauser');
    }
   
        
    
    
}