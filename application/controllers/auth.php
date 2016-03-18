<?php

class Auth extends CI_Controller {
    public $user=null;

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->model('model_global');
        $this->load->library('facebook' , array("appId" =>'965767220143286' ,"secret"=>'2c5a67bbf53a57fc677c9382f615e90f' ));
        $this->user = $this->facebook->getUser();
        }

        function index(){


        	  $data = array('email' => $this->input->post('username'),
                        'password' => sha1($this->input->post('password')),
                        'aktivasi'=>1 
            );
        
            $hasil = $this->model_global->cek_user($data);
            if ($hasil->num_rows() == 1) {
             
                foreach ($hasil->result() as $sess) {
                    
                    $_SESSION['nama']= $sess->nama;
                    $_SESSION['email']=$sess->email;
                    $_SESSION['level']=$sess->level;
                    $_SESSION['id_user']=$sess->id_user;
                    $_SESSION['nama']=$sess->nama;
                    $_SESSION['provinsi']=$sess->provinsi;
                    $_SESSION['daerah']=$sess->daerah;
                    $_SESSION['telp']=$sess->telp;
                    $_SESSION['pin_bb']=$sess->pin_bb;
                    //$_SESSION['password']= $sess->password;
                    
                    
                }
                     redirect('iklansaya');
                

            }else{
                $data_cek['login']=0;
                $data_cek['title']="login";
                $this->load->view('head' ,$data_cek);
                $this->load->view('view_login',$data_cek);
                $this->load->view('footer');


        }

        }
         function masuk(){
            $data['title']="Masuk";
            
            $this->load->view('head',$data);
            $this->load->view('view_login');
            $this->load->view('footer');

        }
        function login_facebook(){
            if (!$this->user) {

                redirect($this->facebook->getLoginUrl());
                //echo $this->facebook->getLoginUrl();
                # code...
            }else{
                // $data['title']="Masuk";
                // $this->load->view('head',$data);
                // $this->load->view('view_login');
                // $this->load->view('footer');
                $user_profile = $this->facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
                //$user_profil=$this->facebook->api('me/');
                $data = array('provider' => 'facebook',
                            'id_user' => $user_profile['id'] 
                );
            
                $hasil = $this->model_global->cek_user($data);
                if ($hasil->num_rows() == 1) {
                     foreach ($hasil->result() as $sess) {
                        //echo $user_profile['email']  ;
                    
                        
                        $_SESSION['email']=$sess->email;
                        $_SESSION['level']=$sess->level;
                        $_SESSION['id_user']=$sess->id_user;
                        $_SESSION['nama']=$sess->nama;
                        $_SESSION['provinsi']=$sess->provinsi;
                        $_SESSION['daerah']=$sess->daerah;
                        $_SESSION['telp']=$sess->telp;
                        $_SESSION['pin_bb']=$sess->pin_bb;
                    //$_SESSION['password']= $sess->password;                 
                    
                    }
                    
                    redirect('iklansaya');
                }else{
                    $nama=$user_profile['first_name'].' '.$user_profile['last_name'];
                    $dataInsert=array(
                    'nama'=>  $nama,
                    'email'=>  '-',
                    'id_user'=> $user_profile['id'],
                    
                    'provider'=> 'facebook' ,
                    'level'=> 'member',
                    'aktivasi'=> 1
                    );
                    echo  $user_profile['id'];
                    $this->load->model('model_user');
                    $this->model_user->register_member($dataInsert);
                    $session=$this->model_user->query_for_control("SELECT * from user where id_user='".$user_profile['id']."' and provider='facebook'");

              
                     $_SESSION['nama']=$session['nama'];
                     $_SESSION['email']=$session['email'];
                     $_SESSION['level']=$session['level'];
                     $_SESSION['id_user']=$session['id_user'];
                     $_SESSION['provinsi']=$session['provinsi'];
                     $_SESSION['daerah']=$session['daerah'];
                     $_SESSION['telp']=$session['telp'];
                     $_SESSION['pin_bb']=$session['pin_bb'];
                      
                    redirect('profil/setting');
                    }
                //echo '<br/>Email : ' . $user_profile['id'];
            }


        }

        function logout(){
            
            session_destroy();
            redirect(site_url());
          

        }

        function register(){
            $data['title']="Register";
            $this->load->view('head',$data);
            $this->load->view('view_register');
            $this->load->view('footer');
        }


        
     
}
?>