<?php

class Kritik_saran extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        
        }

    function index(){
        if ($this->input->post('kritik_saran_submit')){           
            date_default_timezone_set('Asia/Jakarta');
            $nama=$this->input->post('nama');
            $telp=$this->input->post('telp');
            $kritik_saran=$this->input->post('kritik_saran');
            $dataInsert=array(
                'nama'=>  $nama,
                'telp'=>  $telp,
                'kritik_saran'=> $kritik_saran ,
                'tgl'   => date("d/m/Y H:i:s")
            );
            $this->model_global->data_insert($dataInsert,'kritik_saran');
            $data['aktif'] = "kritik_saran";
            $data['title'] = "Kritik dan Saran";
            if (isset($_SESSION['id_user'])) {
                $data['favorit'] = $this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=" . $_SESSION['id_user']);
            }
            $data['judul_konten'] = "Kritik & Saran";
            $data['isi_konten'] = '<div class="alert alert-success" role="alert"><strong>Kritik & Saran berhasil di kirim</strong><br>Terima kasih telah mengirim kritik & saran </div>';
            $this->load->view('head', $data);
            $this->load->view('view_tentang', $data);
            $this->load->view('footer');
        }else{
            $data['aktif'] = "kritik_saran";
            $data['title'] = "Kritik dan Saran";
            if (isset($_SESSION['id_user'])) {
                $data['favorit'] = $this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=" . $_SESSION['id_user']);
            }
            $data['judul_konten'] = "Kritik & Saran";
            $data['isi_konten'] = '<form method="POST" action="' . site_url() . 'kritik_saran" >
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" name="nama" id="" placeholder="Nama" required>
                </div>
                <div class="form-group">
                  <label>No. Telp</label>
                  <input type="number" class="form-control" name="telp" placeholder="Telp" required>
                </div>
                <div class="form-group">
                  <label>Kritik & saran</label>
                  <textarea class="form-control" rows="3" name="kritik_saran" required ></textarea>
                </div>

                <button type="submit" class="btn btn-primary" value="kirim" name="kritik_saran_submit" >Kirim</button>
              </form>';
            $this->load->view('head', $data);
            $this->load->view('view_tentang', $data);
            $this->load->view('footer');
        }
        
        
    }
        

       
}
?>
