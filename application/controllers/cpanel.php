<?php

class Cpanel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        }

        function index(){
            redirect('https://srv12.niagahoster.com:2083/');


        	 
       
        }
         function masuk(){
            $data['title']="Masuk";
            
            $this->load->view('head',$data);
            $this->load->view('view_login');
            $this->load->view('footer');

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
