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
        $data['isi_konten']='- Otomotifstore.com tidak berperan sebagai penjual barang namun sebagai sarana bertemunya penjual dan pembeli<br>
- Barang yang diiklankan di Otomotifstore merupakan barang yang tidak tercantum di dalam daftar “barang terlarang”<br>
- Pengguna Otomotifstore.com bertanggung jawab atas keamanan penggunaan akun termasuk email dan password<br>
- Dengan mengakses atau menggunakan situs otomotifstore.com, maka setiap pengguna dianggap telah menerima, memahami serta menyetujui untuk mematuhi semua isi dalam syarat dan ketentuan ini. Syarat dan ketentuan dapat diubah atau diperbarui sewaktu-waktu oleh otomotifstore.com tanpa ada pemberitahuan terlebih dahulu.<br>
- Untuk informasi dan pengaduan silahkan hubungi cs@otomotifstore.com <br>
<br>
<h3>PEMBATASAN TANGGUNG JAWAB</h3>
<ol class="list-group">
	<li>1. Otomotifstore.com tidak bertanggung jawab atas segala risiko dan kerugian yang kaitannya dengan informasi yang dituliskan pengguna di Otomotifstore.com</li>
	<li>2. Otomotifstore.com tidak bertanggung jawab atas kualitas barang, proses pengiriman, rusaknya reputasi pihak lain, dan segala bentuk perselisihan yang terjadi antar pengguna situs.</li>
	<li>3. Otomotifstore.com tidak bertanggung jawab atas segala pelanggaran hak cipta, merek, desain industri, hak paten atau hak-hak pribadi lain yang melekat atas suatu barang, berkenaan dengan segala informasi yang dibuat oleh penjual.</li>
	<li>4. Otomotifstore.com tidak bertanggung jawab atas segala risiko dan kerugian atas peretasan akun pengguna yang dilakukan oleh pihak ketiga</li>
</ol>
<br>
<h3>BARANG TERLARANG</h3>
<p>Otomotifstore.com akan terus melakukan hal-hal sebagaimana dipersyaratkan oleh peraturan perundang-undangan untuk mencegah terjadinya perdagangan barang-barang yang melanggar ketentuan hukum yang berlaku dan hak pribadi pihak ketiga. Berkenaan dengan hal tersebut, berikut adalah barang-barang yang dilarang untuk diperjual belikan melalui Otomotifstore.com:</p>

<ol style="margin-left:15px;margin-top:15px;">
	<li>1. Segala bentuk tulisan yang dapat berpengaruh negatif terhadap pemakaian situs ini.</li>
	<li>2. Barang yang berhubungan dengan kepolisian</li>
	<li>3. Barang yang belum tersedia (pre order)</li>
	<li>4. Barang curian</li>
	<li>5. Pembuka kunci dan segala aksesori penunjang tindakan perampokan/pencurian</li>
	<li>6. STNK dan atau BPKB yang tidak dijual bersamaan dengan kendaraan yang dimaksud dalam STNK dan atau BPKB tersebut</li>
	<li>7. Barang-barang lain yang dilarang untuk diperjualbelikan secara bebas berdasarkan hukum yang berlaku di Indonesia</li>
</ol>


';
        $this->load->view('head',$data);
        $this->load->view('view_tentang',$data);
        $this->load->view('footer');
    }
        

       
}
?>
