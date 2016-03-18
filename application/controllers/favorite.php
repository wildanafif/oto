<?php

class Favorite extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_iklan');
        session_start();
        if (!isset($_SESSION['id_user'])) {
                redirect('home');
            }
        }

        function index(){
            $this->load->model('model_global');
            $id_user=$_SESSION['id_user'];
             $this->load->library('pagination');
            $this->load->library('table');
            $id_user=$_SESSION['id_user'];

            $config['base_url'] = base_url()."favorite/page";
            //jumlah total data
            $config['total_rows'] =  $this->model_global->total_paging("SELECT * FROM favorite t , iklan i WHERE i.id_iklan=t.id_iklan and t.id_user=$id_user");
            //jumlah data per halaman
            //jumlah data per halaman
            $config['per_page']=9;
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
            $limit=0;
            if ($this->uri->segment(3)==null) {
               
            }else{
                $limit=$this->uri->segment(3);
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM favorite t , iklan i WHERE i.id_iklan=t.id_iklan and t.id_user=$id_user ORDER BY t.id_favorite DESC LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
           // $data['kategori']=  $this->model_iklan->getAll_kategori();
            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $this->load->view('head',$data);
            $this->load->view('view_iklan_favorit',$data);
            $this->load->view('footer');
        }

        function page(){
           $this->load->model('model_global');
            $id_user=$_SESSION['id_user'];
             $this->load->library('pagination');
            $this->load->library('table');
            $id_user=$_SESSION['id_user'];

            $config['base_url'] = base_url()."favorite/page";
            //jumlah total data
            $config['total_rows'] =  $this->model_global->total_paging("SELECT * FROM favorite t , iklan i WHERE i.id_iklan=t.id_iklan and t.id_user=$id_user");
            //jumlah data per halaman
            //jumlah data per halaman
            $config['per_page']=9;
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
            $limit=0;
            if ($this->uri->segment(3)==null) {
               
            }else{
                $limit=$this->uri->segment(3);
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM favorite t , iklan i WHERE i.id_iklan=t.id_iklan and t.id_user=$id_user ORDER BY t.id_favorite DESC LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
           // $data['kategori']=  $this->model_iklan->getAll_kategori();
            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $this->load->view('head',$data);
            $this->load->view('view_iklan_favorit',$data);
            $this->load->view('footer');
        }

        function add(){
            $id_iklan = abs((int)$this->uri->segment(3));
            $waktu = abs((int)$this->uri->segment(4));
            $data_cek = array('id_user' => $_SESSION['id_user'] ,
                                'id_iklan' => $id_iklan);
            $cek=$this->model_iklan->cek_boolean($data_cek ,"favorite");
             if ($cek->num_rows() == 1){
                echo "<script>alert('Iklan sudah ada dalam daftar favorit anda');history.go(-1);</script>";

            }else{

                $this->model_iklan->query_insert("INSERT INTO `favorite`( `id_user`, `id_iklan`) VALUES (".$_SESSION['id_user'].",$id_iklan)");
                                echo "<script>alert('Iklan berhasil ditambahkan dalam daftar favorit anda');history.go(-1);</script>";

            }
            
        }

        function hapus(){
            $id_iklan = abs((int)$this->uri->segment(3));
            $this->model_iklan->query_insert("DELETE FROM `favorite` WHERE id_iklan=$id_iklan and id_user=".$_SESSION['id_user']);
               echo "<script>alert('Iklan sudah dihapus dari daftar favorit anda');history.go(-1);</script>";

            



        }
        

       
}
?>
