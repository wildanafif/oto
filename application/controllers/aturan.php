<?php

class Aturan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        
        }

    function index(){
        $data['aktif']="aturan";
        if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

        }
        $data['title']="Aturan Umum";
        $data['judul_konten']="Aturan umum Otomotifstore.com";
        $data['isi_konten']="Syarat dan ketentuan yang ada di halaman ini adalah para pengguna situs otomotifstore.com, baik sebagai pengguna ataupun pengunjung situs, pemasang iklan, maupun calon pembeli untuk patuh pada hal-hal yang telah ditetapkan otomotifstore.com.<br><br>
                            Dengan mengakses atau menggunakan situs otomotifstore.com, maka setiap pengguna dianggap telah menerima, memahami serta menyetujui untuk mematuhi semua isi dalam syarat dan ketentuan ini. Syarat dan ketentuan dapat diubah atau diperbarui sewaktu-waktu oleh otomotifstore.com tanpa ada pemberitahuan terlebih dahulu. Apabila pengguna tidak setuju atas syarat dan ketentuan ini, kami sebagai situs otomotifstore.com mempersilahkan untuk tidak melanjutkan penggunaan situs ini.";
        $this->load->view('head',$data);
        $this->load->view('view_tentang',$data);
        $this->load->view('footer');
    }
        

       
}
?>
