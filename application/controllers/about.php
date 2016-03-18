<?php

class About extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        
        }

    function index(){
        $data['aktif']="about";
        $data['title']="Tentang Kami";
        if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

        }
        $data['judul_konten']="Tentang Otomotifstore.com";
        $data['isi_konten']="Otomotifstore.com merupakan situs  jual beli online bidang otomotif di Indonesia. Otomotifstore.com sebagai perantara penjual untuk memasang iklan dan bagi pembeli yang mencari barang otomotif bekas maupun baru. Terdapat berbagai kategori mulai dari mobil, motor dan jasa/sewa. Otomotifstore.com mudah digunakan oleh siapa saja dan pemasangan iklan gratis.";
        $this->load->view('head',$data);
        $this->load->view('view_tentang',$data);
        $this->load->view('footer');
    }
        

       
}
?>
