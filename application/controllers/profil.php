<?php

class Profil extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->model('model_global');
            if (!isset($_SESSION['id_user'])) {
                redirect('home');
            }
        }

        function index(){

            $data['title']="Profil";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            
            $this->load->view('head',$data);
            $this->load->view('view_profil');
            $this->load->view('footer');

        }
        function setting(){
            $this->load->model('model_iklan');
            $data['data']=  $this->model_iklan->getAll_prov();
          
             $data['title']="Profil";
             $data['class_active']="setting";
             $this->load->model('model_global');
             $data['profil']=$this->model_global->query_for_control("SELECT * from user where id_user=".$_SESSION['id_user']);
            if ( $this->uri->segment(3)) {
               $data['perbarui']=1;
            }
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $this->load->view('head',$data);
            $this->load->view('view_profil' , $data);
            $this->load->view('footer');

        }
         function masuk(){
            $data['title']="Masuk";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            
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
