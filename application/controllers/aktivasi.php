<?php

class Aktivasi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        // if (!isset($_SESSION['aktivasi'])) {
        //         redirect('home');
        //     }
         }

        function index(){
            $data['title']="Aktivasi";
            $this->load->view('head',$data);
            $this->load->view('view_send_activation');
            $this->load->view('footer');
        }
        function verifikasi(){
            $id_user=$this->uri->segment(4);
            $kode_aktivasi=$this->uri->segment(5);
            $data_cek = array('id_user' => $id_user,
                                'kode_aktivasi' => $kode_aktivasi
                       
            );
            $hasil = $this->model_global->cek_user($data_cek);
            if ($hasil->num_rows() == 1) {
                $this->model_global->query_insert("UPDATE `user` SET `aktivasi`=1,`kode_aktivasi`='' WHERE id_user=$id_user and kode_aktivasi='$kode_aktivasi'");
                $data['title']="Aktivasi";
                $this->load->view('head',$data);
                $this->load->view('view_verifikasi_aktivasi');
                $this->load->view('footer');
            }else{
               redirect('error');
            }

     
        }
}
?>
