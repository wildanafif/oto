<?php

class Iklansaya extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_iklan');
        session_start();
        if (!isset($_SESSION['id_user'])) {
                redirect('home');
            }
        }

        function index(){
            $id_user=$_SESSION['id_user'];
           $data['user']=$this->model_iklan->query_for_control("SELECT * From user where id_user=".$id_user);
             $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."iklansaya/page";
            //jumlah total data
              $config['total_rows'] = $this->model_iklan->Total_iklan_detail($id_user);
            //jumlah data per halaman
            $config['per_page']=10;
            //jumah link no halaman 
            $config['num_links'] = 5;
            //segment URL yang akan dijadikan pemotongan data
            //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
            $config['uri_segment'] = 4;
            // awal membuka penomoran 
            // menggunakan class bootstrap
            $config['full_tag_open'] = '<ul class="pagination">';
            // akhi membuka penomoran 
            $config['full_tag_close'] = '</ul>';
            //pembuka link ke awal data
            $config['first_tag_open'] = '<li>';
            //penutup link ke akhir data
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            //class untuk halaman aktif
            $config['cur_tag_open'] = '<li class="active"><a href="#"><span class="sr-only">(current)</span>';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
        //class bootstrap untuk awal halaman
            $config['first_link']='<span class="glyphicon glyphicon-fast-backward"></span>';
        //class bootstrap untuk akhir halaman
            $config['last_link']='<span class="glyphicon glyphicon-fast-forward"></span>';
        //class bootstrap untuk  halaman berikutnya
            $config['next_link']='<span class="glyphicon glyphicon-step-forward"></span>';
        //class bootstrap untuk  halaman sebelumnya
            $config['prev_link']='<span class="glyphicon glyphicon-step-backward"></span>';
    // inisialisasi paging
            $this->pagination->initialize($config);
    // membuat paging dan disimpan dalam array $halaman
            $data['halaman']=$this->pagination->create_links();
    // mengambil data per halaman
            $data['produk'] = $this->model_iklan->Tampil_iklan_user($config['per_page'], $this->uri->segment(3) , $id_user);
    // kirim data dan hasil paging ke file application/views/v_produk.php
            $data['kategori']=  $this->model_iklan->getAll_kategori();
            $data['title']=  "Otomotif Store";
             if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $this->load->view('head',$data);
            $this->load->view('view_iklan_saya',$data);
            $this->load->view('footer');
        }

        function page(){
             $id_user=$_SESSION['id_user'];
           $data['user']=$this->model_iklan->query_for_control("SELECT * From user where id_user=".$id_user);
             $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."iklansaya/page";
            //jumlah total data
              $config['total_rows'] = $this->model_iklan->Total_iklan_detail($id_user);
            //jumlah data per halaman
            $config['per_page']=10;
            //jumah link no halaman 
            $config['num_links'] = 5;
            //segment URL yang akan dijadikan pemotongan data
            //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
            $config['uri_segment'] = 3;
            // awal membuka penomoran 
            // menggunakan class bootstrap
            $config['full_tag_open'] = '<ul class="pagination">';
            // akhi membuka penomoran 
            $config['full_tag_close'] = '</ul>';
            //pembuka link ke awal data
            $config['first_tag_open'] = '<li>';
            //penutup link ke akhir data
            $config['first_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            //class untuk halaman aktif
            $config['cur_tag_open'] = '<li class="active"><a href="#"><span class="sr-only">(current)</span>';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
        //class bootstrap untuk awal halaman
            $config['first_link']='<span class="glyphicon glyphicon-fast-backward"></span>';
        //class bootstrap untuk akhir halaman
            $config['last_link']='<span class="glyphicon glyphicon-fast-forward"></span>';
        //class bootstrap untuk  halaman berikutnya
            $config['next_link']='<span class="glyphicon glyphicon-step-forward"></span>';
        //class bootstrap untuk  halaman sebelumnya
            $config['prev_link']='<span class="glyphicon glyphicon-step-backward"></span>';
    // inisialisasi paging
            $this->pagination->initialize($config);
    // membuat paging dan disimpan dalam array $halaman
            $data['halaman']=$this->pagination->create_links();
    // mengambil data per halaman
            $data['produk'] = $this->model_iklan->Tampil_iklan_user($config['per_page'], $this->uri->segment(3) , $id_user);
    // kirim data dan hasil paging ke file application/views/v_produk.php
            $data['kategori']=  $this->model_iklan->getAll_kategori();
            $data['title']=  "Otomotif Store";
             if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $this->load->view('head',$data);
            $this->load->view('view_iklan_saya',$data);
            $this->load->view('footer');

        }
        

         function register_member(){
            $email=$this->input->post('email');
            $pwd=sha1($this->input->post('password')) ;
            $dataInsert=array(
                'nama'=>  $this->input->post('nama'),
                'email'=>  $this->input->post('email'),
                'password'=> sha1($this->input->post('password')) ,
                'level'=> 'member'
            );
            $this->model_user->register_member($dataInsert);
            $session=$this->model_user->query_for_control("SELECT * from user where email='$email' and password='$pwd'");
           // echo $session['nama'];
            $_SESSION['nama']=$session['nama'];
             $_SESSION['email']=$session['email'];
             $_SESSION['level']=$session['level'];
             $_SESSION['id_user']=$session['id_user'];
            redirect('profil/setting');
        }

        function perbarui(){
            
            $daerah=$this->input->post('daerah');
            $telp=$this->input->post('telp');
            $pin_bb=$this->input->post('pin_bb');
            $data_prov = $this->model_user->query_for_control("SELECT * from provinsi where id_provinsi=".$this->input->post('provinsi'));
            $provinsi=$data_prov['nama_provinsi'];
            $this->model_user->query_insert("UPDATE `user` SET `provinsi`='$provinsi',`daerah`='$daerah',`telp`='$telp',`pin_bb`='$pin_bb' WHERE id_user=".$_SESSION['id_user']);
            redirect('profil/setting/1');
         }
        
        function insert(){
            $dataInsert=array(
                'nim'=>  $this->input->post('nim'),
                'nama'=>  $this->input->post('nama'),
                'alamat'=> $this->input->post('alamat')
            );
            $this->model_mahasiswa->insert($dataInsert);
            redirect('mahasiswa');
        }
        
        function delete(){
            $id=$this->uri->segment(3);// uri segment 3 maksudnya bagian ketiga setelah site_url, 
            $this->model_mahasiswa->delete($id);//mahasiswa(1)/delete(2)/0803xxx(3)
            redirect('mahasiswa');
        }
        
        function ubah(){
            $id=$this->uri->segment(3);
            $data['data']=$this->model_mahasiswa->get_by_id($id);
            $this->load->view('update_mahasiswa',$data);
        }
        
        function update(){
            $id=$this->input->post('nim');
            $dataUpdate=array(
                'nama'=>  $this->input->post('nama'),
                'alamat'=>  $this->input->post('alamat')
            );
            $this->model_mahasiswa->update($id,$dataUpdate);
            redirect('mahasiswa');
        }
}
?>
