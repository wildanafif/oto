<?php

class Tips extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        
        }

    function index(){
        $data['aktif']="tips";
        if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
        $data['title']="TIPS JUAL BELI AMAN";
        $data['judul_konten']="TIPS JUAL BELI AMAN";
        $data['isi_konten']=" <br><b>Penjual</b><br></br>
                                -(Usahakan daftar sebagai member) agar pembeli dapat melihat iklan-iklan di profil anda.<br>
                                -(Lengkapi deskripsi iklan) agar pembeli tahu detail dan spesifikasi barang yang anda jual<br>
                                -(Usahakanketemuan/COD)<br>
                                -(Pilih jasa pengiriman murah & terpercaya) agar barang yang anda kirim aman dan tidak berat di ongkos kirim.
                                <br><br>
                                <br><b>Pembeli</b><br></br>
                                -(Usahakan ketemuan/COD) agar barang yang akan dibeli sesuai dengan keinginan.<br>
                                -(Cari informasi penjual) sebelum melakukan pembayaran transfer usahakan meminta identitas diri penjual (SIM/KTP) agar meminimalisir terjadinya penipuan

";
        $this->load->view('head',$data);
        $this->load->view('view_tentang',$data);
        $this->load->view('footer');
    }
        

       
}
?>
