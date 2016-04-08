<?php

class Error extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_iklan');
        }

        function index(){
        	$data['title']="404 error";
         //	$data['kategori']=  $this->model_iklan->getAll_kategori();
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $data['kategori']=  $this->model_iklan->getAll_kategori();
            $data['prov']=$this->model_iklan->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('404');
            $this->load->view('footer',$data);

        }


        
     
}
?>
