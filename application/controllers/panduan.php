<?php

class Panduan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        
        }

    function index(){
        $data['aktif']="panduan";
        if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
        $data['title']="Panduan";
        $data['judul_konten']="Panduan Otomotifstore.com";
        $data['isi_konten']=' <h3 style="margin-bottom:10px;"> Cara daftar akun</h3> <center><iframe width="500" height="315" src="https://www.youtube.com/embed/gqyMpaxUdtE?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></center><hr> <h3 style="margin-bottom:10px;"> Cara pasang iklan</h3> <center><iframe width="500" height="315" src="https://www.youtube.com/embed/Mhln4M1bUCo?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></center>';
        $this->load->view('head',$data);
        $this->load->view('view_tentang',$data);
        $this->load->view('footer');
    }
        

       
}
?>
