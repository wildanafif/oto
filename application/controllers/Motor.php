<?php

class Motor extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->model('model_iklan');
        }

        function index(){
           
        $this->load->library('pagination');
        $this->load->library('table');

        $config['base_url'] = base_url()."Motor/page";
        //jumlah total data
          $config['total_rows'] = $this->model_iklan->TotalPosting_kategori($this->uri->segment(1));
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
        $data['produk'] = $this->model_iklan->TampilPosting_kategori($config['per_page'], $this->uri->segment(3) , $this->uri->segment(1));
// kirim data dan hasil paging ke file application/views/v_produk.php
        //inisisalisasi
        $data['title_kategori']="Motor";
        $kategori=$this->model_iklan->query_for_control("SELECT * From kategori where nama_kategori='Motor'");
        $data['sub_kategori']=$this->model_iklan->query_getAll("SELECT * From sub_kategori where id_kategori=".$kategori['id_kategori']);
        $data['tab_active']='semua';
        //akhir inisial
        $data['kategori']=  $this->model_iklan->getAll_kategori();
        $data['title']=  "Otomotif Store";
        if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
        $data['prov']=$this->model_iklan->query_getAll("SELECT * From provinsi");
        $this->load->view('head',$data);
        $this->load->view('view_kategori',$data);
        $this->load->view('footer',$data);


        }

        function page(){
       $this->load->library('pagination');
        $this->load->library('table');

        $config['base_url'] = base_url()."Motor/page";
        //jumlah total data
          $config['total_rows'] = $this->model_iklan->TotalPosting_kategori($this->uri->segment(1));
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
        $data['produk'] = $this->model_iklan->TampilPosting_kategori($config['per_page'], $this->uri->segment(3) , $this->uri->segment(1));
// kirim data dan hasil paging ke file application/views/v_produk.php
        //inisisalisasi
        $data['title_kategori']="Motor";
        $kategori=$this->model_iklan->query_for_control("SELECT * From kategori where nama_kategori='Motor'");
        $data['sub_kategori']=$this->model_iklan->query_getAll("SELECT * From sub_kategori where id_kategori=".$kategori['id_kategori']);
        $data['tab_active']='semua';
        //akhir inisial
        $data['kategori']=  $this->model_iklan->getAll_kategori();
        $data['title']=  "Otomotif Store";
        if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
       $data['prov']=$this->model_iklan->query_getAll("SELECT * From provinsi");
        $this->load->view('head',$data);
        $this->load->view('view_kategori',$data);
        $this->load->view('footer',$data);
        }


         function sub_kategori(){
        $this->load->model('model_global');
        $segment_data=mysql_real_escape_string($this->uri->segment(3));
        $sub_kategori=str_replace("-", " ", $segment_data);
         
        $where= "sub_kategori='".$sub_kategori."'";
            


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."Motor/page_sub_c/".$segment_data."/";
            //jumlah total data
            $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
            //jumlah data per halaman
            $config['per_page']=9;
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
            $limit=0;
            if ($this->uri->segment(4)==null) {
               
            }else{
                $limit=mysql_escape_string($this->uri->segment(4));
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." ORDER BY id_iklan DESC  LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php


        //inisisalisasi
        
        $data['title_kategori']="Motor";
        $kategori=$this->model_global->query_for_control("SELECT * From kategori where nama_kategori='Motor'");
        $data['sub_kategori']=$this->model_global->query_getAll("SELECT * From sub_kategori where id_kategori=".$kategori['id_kategori']);
        $data['tab_active']=$sub_kategori;
        $data['title']=$sub_kategori;
        //akhir inisial
        if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
        $data['prov']=$this->model_iklan->query_getAll("SELECT * From provinsi");
        $this->load->view('head',$data);
        $this->load->view('view_kategori',$data);
        $this->load->view('footer',$data);

    }

    function page_sub_c(){

         $this->load->model('model_global');
        $segment_data=mysql_real_escape_string($this->uri->segment(3));
        $sub_kategori=str_replace("-", " ", $segment_data);
         
        $where= "sub_kategori='".$sub_kategori."'";
            


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."Motor/page_sub_c/".$segment_data."/";
            //jumlah total data
            $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
            //jumlah data per halaman
            $config['per_page']=9;
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
            $limit=0;
            if ($this->uri->segment(4)==null) {
               
            }else{
                $limit=mysql_real_escape_string($this->uri->segment(4));
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." ORDER BY id_iklan DESC  LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php


        //inisisalisasi
        
        $data['title_kategori']="Motor";
        $kategori=$this->model_global->query_for_control("SELECT * From kategori where nama_kategori='Motor'");
        $data['sub_kategori']=$this->model_global->query_getAll("SELECT * From sub_kategori where id_kategori=".$kategori['id_kategori']);
        $data['tab_active']=$sub_kategori;
        $data['title']=$sub_kategori;
        //akhir inisial
        if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
        $data['prov']=$this->model_iklan->query_getAll("SELECT * From provinsi");
        $this->load->view('head',$data);
        $this->load->view('view_kategori',$data);
        $this->load->view('footer',$data);

    }


}
?>
