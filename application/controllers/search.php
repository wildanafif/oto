<?php

class Search extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        }

    function index(){
           

    }
    function cari(){
        if ($this->input->get('kategori')!='' && $this->input->get('wilayah')=='' && $this->input->get('sesuatu')=='')  {
           $kategori=mysql_escape_string($this->input->get('kategori'));
           $data_kategori=explode("->",$kategori);
           $jumlah_kategori=count(explode("->", $kategori));
           if ($jumlah_kategori==1) {
                redirect(site_url().$kategori);
           }elseif($jumlah_kategori==2) {
               $judul_url=str_replace(" ", "-", $data_kategori[1]);
               redirect(site_url().'search/page_cat2/'.$data_kategori[0].'/'.$judul_url);
           }
        }elseif ($this->input->get('kategori')=='' && $this->input->get('wilayah') !=='' && $this->input->get('sesuatu')=='') {
           $wilayah=mysql_real_escape_string($this->input->get('wilayah'));
           redirect(site_url().'search/search_?wilayah='.$wilayah);
        }elseif ($this->input->get('kategori')=='' && $this->input->get('wilayah')=='' && $this->input->get('sesuatu')!='') {
           $sesuatu=mysql_real_escape_string($this->input->get('sesuatu'));
           redirect(site_url().'search/search_?sesuatu='.$sesuatu);

        //kategori dan wilayah tidak kosong
        }elseif ($this->input->get('kategori')!='' && $this->input->get('wilayah')!='' && $this->input->get('sesuatu')=='') {
            $escape_wilayah=mysql_real_escape_string($this->input->get('wilayah'));
            $jumlah_wilayah=count(explode("->", $escape_wilayah));
            $kategori=$this->input->get('kategori');
           
            $data_lokasi=explode("->",$escape_wilayah);
            $data_kategori=explode("->",$kategori);
            $jumlah_kategori=count(explode("->", $kategori));
            
            if ($jumlah_wilayah==1) {
                 $provinsi=$data_lokasi[0];
                 $judul_url=str_replace(" ", "-", $provinsi);

                if ($jumlah_kategori==2) {
                    $judul_url_sub_kategori=str_replace(" ", "-", $data_kategori[1]);
                    redirect(site_url().'search/page_cat2_wil1/'.$judul_url.'/'.$data_kategori[0].'/'.$judul_url_sub_kategori);
                }elseif($jumlah_kategori==1){


                   
                    
                    $where= "provinsi='".$provinsi."' and kategori='".$kategori."' ";
                    $this->load->library('pagination');
                    $this->load->library('table');

                    $config['base_url'] = base_url()."search/page_prov_cat1/". $judul_url."/".$kategori;
                    //jumlah total data
                      $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
                    $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");


                    $data['title']=  "Otomotif Store";
                    if (isset($_SESSION['id_user'])) {
                      $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                    }
                    $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                    $this->load->view('head',$data);
                    $this->load->view('view_search',$data);
                    $this->load->view('footer',$data);
                }






            }elseif ($jumlah_wilayah==2) {
                $provinsi=$data_lokasi[0];
                $daerah=$data_lokasi[1];
                $judul_url=str_replace(" ", "-", $provinsi);
                $judul_url .= '+'.str_replace(" ", "-", $daerah);
                if ($jumlah_kategori==2) {
                    $judul_url_sub_kategori=str_replace(" ", "-", $data_kategori[1]);
                    redirect(site_url().'search/page_cat2_wil2/'.$judul_url.'/'.$data_kategori[0].'/'.$judul_url_sub_kategori);
                }elseif ($jumlah_kategori==1) {
                    # code...
                
                    
                    $where= "provinsi='".$provinsi."' and daerah='". $daerah ."' and kategori='".$kategori."' ";
                     $this->load->library('pagination');
                    $this->load->library('table');

                    $config['base_url'] = base_url()."search/page_prov_cat2/". $judul_url."/".$kategori;
                    //jumlah total data
                      $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
                    $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
        // kirim data dan hasil paging ke file application/views/v_produk.php
                    if (isset($_SESSION['id_user'])) {
                      $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                    }
                    $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                    $data['title']=  "Otomotif Store";
                    $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                    $this->load->view('head',$data);
                    $this->load->view('view_search',$data);
                    $this->load->view('footer',$data);
                
                }
               
            }
        //kategori dan cari sesuatu tidak kosong
        }elseif ($this->input->get('kategori')!='' && $this->input->get('wilayah')=='' && $this->input->get('sesuatu')!='') {
            $cari_sesuatu=mysql_real_escape_string($this->input->get('sesuatu'));
            $kategori=$this->input->get('kategori');
            $judul_url=str_replace(" ", "-", $cari_sesuatu);
            $data_kategori=explode("->",$kategori);
            $jumlah_kategori=count(explode("->", $kategori));
            if ($jumlah_kategori==2) {
                $judul_url_sub_kategori=str_replace(" ", "-", $data_kategori[1]);
                redirect(site_url().'search/page_cat2_ses/'.$judul_url.'/'.$data_kategori[0].'/'.$judul_url_sub_kategori);
            }elseif ($jumlah_kategori==1) {
                # code...
                $where= "kategori='".$kategori."' and (judul_iklan LIKE "."'%". $cari_sesuatu."%'";
              
                
                $queryString = explode(' ', $cari_sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                  
                }
                $where .=")" ;



                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_cat_ses/". $judul_url."/".$kategori;
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
        // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
               
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);
            }
        }elseif ($this->input->get('kategori')=='' && $this->input->get('wilayah')!='' && $this->input->get('sesuatu')!='') {
            
            $wilayah=$this->input->get('wilayah');
            $sesuatu=$this->input->get('sesuatu');
            redirect(site_url().'search/search_?wilayah='.$wilayah.'&sesuatu='.$sesuatu);
        }elseif ($this->input->get('kategori')!='' && $this->input->get('wilayah')!='' && $this->input->get('sesuatu')!='') {
            $escape_wilayah=mysql_real_escape_string($this->input->get('wilayah'));
            $jumlah_wilayah=count(explode("->", $escape_wilayah));
            $kategori=mysql_real_escape_string($this->input->get('kategori'));
            $cari_sesuatu=mysql_real_escape_string($this->input->get('sesuatu'));
            $provinsi=$data_lokasi[0];
            $judul_url=str_replace(" ", "-", $provinsi);
           
            $data_lokasi=explode("->",$escape_wilayah);
            $data_kategori=explode("->",$kategori);
            $jumlah_kategori=count(explode("->", $kategori));

            
            if ($jumlah_wilayah==1) {
                
                if ($jumlah_kategori==2) {
                    $judul_url_sub_kategori=str_replace(" ", "-", $data_kategori[1]);
                    redirect(site_url().'search/page_cat2_lok_ses1'.'/'.$data_kategori[0].'/'.$judul_url.'/'.$cari_sesuatu.'/'.$judul_url_sub_kategori);
                }elseif ($jumlah_kategori==1) {
                    
                    //$where= "kategori='".$kategori."' and (judul_iklan LIKE "."'%". $cari_sesuatu."%'";
                    $where= "provinsi='".$provinsi."' and kategori='".$kategori."' and (judul_iklan LIKE "."'%". $cari_sesuatu."%'";
                    $queryString = explode(' ', $cari_sesuatu);
                    foreach ($queryString as $key => $value) {
                        $where .= " OR judul_iklan LIKE '%".$value."%'";
                        $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                       
                    }
                    $where .=")" ;

                    $this->load->library('pagination');
                    $this->load->library('table');

                    $config['base_url'] = base_url()."search/page_cat_lok_ses1/". $kategori."/".$judul_url."/".$cari_sesuatu;
                    //jumlah total data
                      $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
                    $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");


                    $data['title']=  "Otomotif Store";
                    if (isset($_SESSION['id_user'])) {
                      $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                    }
                    $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                    $this->load->view('head',$data);
                    $this->load->view('view_search',$data);
                    $this->load->view('footer',$data);
                }
                


            }elseif ($jumlah_wilayah==2) {
                if ($jumlah_kategori==2) {
                    $judul_url_sub_kategori=str_replace(" ", "-", $data_kategori[1]);
                    $provinsi=$data_lokasi[0];
                    $judul_url=str_replace(" ", "-", $provinsi);
                    $judul_url_daerah=str_replace(" ", "-", $data_lokasi[1]);
                    redirect(site_url().'search/page_cat2_lok_ses2'.'/'.$data_kategori[0].'/'.$judul_url.'/'.$cari_sesuatu.'/'.$judul_url_daerah.'/'.$judul_url_sub_kategori);
                    
                }elseif ($jumlah_kategori==1) {
                    $provinsi=$data_lokasi[0];
                    $judul_url=str_replace(" ", "-", $provinsi);
                    $judul_url_daerah=str_replace(" ", "-", $data_lokasi[1]);
                    redirect(site_url().'search/page_cat1_lok_ses2'.'/'.$data_kategori[0].'/'.$judul_url.'/'.$cari_sesuatu.'/'.$judul_url_daerah);
                    
                }

               
            }
        }else{
            redirect(site_url().'search/all');

        }
    }

    function data_lokasi_modal(){
        $id=$this->input->post('id_provinsi');
        $data_prov=$this->model_global->query_for_control("SELECT * From provinsi where id_provinsi=$id");

        $data=$this->model_global->query_getAll("SELECT * From daerah where id_provinsi=$id");
        echo '  <div class="col-md-4" style="margin-top:10px;"><a href="#"  data-dismiss="modal"  disabled style=";"><i><b>Semua provinsi '.$data_prov['nama_provinsi'].' ...</b></i> </a></div>';

        foreach ($data as $key ) {
            echo '  <div class="col-md-4" style="margin-top:10px;"><a href="#" onClick="add_lokasi(\''.$key->nama_daerah.'\')"  data-dismiss="modal" disabled style=";"><i>'.$key->nama_daerah.'</i> </a></div>';
        }
    }
    function search_(){
        if ($this->input->get('wilayah')!='' && $this->input->get('sesuatu')=='') {
            $escape_wilayah=mysql_real_escape_string($this->input->get('wilayah'));
            $jumlah_wilayah=count(explode("->", $escape_wilayah));
           
            $data_lokasi=explode("->",$escape_wilayah);
            
            if ($jumlah_wilayah==1) {
                $provinsi=$data_lokasi[0];
                $judul_url=str_replace(" ", "-", $provinsi);
                $where= "provinsi='".$provinsi."'";
                $this->load->library('pagination');
                $this->load->library('table');
                



                $config['base_url'] = base_url()."search/page_prov/". $judul_url;
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

                $data['title']=  "Otomotif Store";
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }

                
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);


            }elseif ($jumlah_wilayah==2) {
                $provinsi=$data_lokasi[0];
                $daerah=$data_lokasi[1];
                $judul_url=str_replace(" ", "-", $provinsi);
                $judul_url .= '+'.str_replace(" ", "-", $daerah);
                $where= "provinsi='".$provinsi."' and daerah= '". $daerah ."'";
                 $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_location/". $judul_url;
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']='Otomotif Store';
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);
                

               
            }
        }elseif ($this->input->get('sesuatu')!='' && $this->input->get('wilayah')=='') {
            $cari_sesuatu=mysql_real_escape_string($this->input->get('sesuatu'));
            $where="judul_iklan ='$cari_sesuatu'";
            $judul_url=str_replace(" ", "-", $cari_sesuatu);
            $queryString = explode(' ', $cari_sesuatu);
            foreach ($queryString as $key => $value) {
                $where .= " OR judul_iklan LIKE '%".$value."%'";
                $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                
            }
            $where .= " OR judul_iklan LIKE '%".$cari_sesuatu."%'";
            



            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/page_ses/". $judul_url;
            //jumlah total data
              $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
           
            $data['title']=  "Otomotif Store";
            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);
        }elseif ($this->input->get('sesuatu')!='' && $this->input->get('wilayah')!='') {
            $escape_wilayah=mysql_real_escape_string($this->input->get('wilayah'));
            $jumlah_wilayah=count(explode("->", $escape_wilayah));
           
            $data_lokasi=explode("->",$escape_wilayah);
            $cari_sesuatu=mysql_real_escape_string($this->input->get('sesuatu'));
            
            if ($jumlah_wilayah==1) {
                $provinsi=$data_lokasi[0];
                $judul_url1=str_replace(" ", "-", $provinsi);
                $judul_url2=str_replace(" ", "-", $cari_sesuatu);
                $judul_url=$judul_url1."+".$judul_url2;

                $where= "provinsi='".$provinsi."' and (judul_iklan LIKE "."'%". $cari_sesuatu."%'";
                
            
                $queryString = explode(' ', $cari_sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                    
                }
                 $where .=")" ;


                 $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/prov_some/". $judul_url;
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

            }elseif ($jumlah_wilayah==2) {
                $provinsi=$data_lokasi[0];
                $daerah=$data_lokasi[1];
                $judul_url0=str_replace(" ", "-", $provinsi);
                $judul_url1=str_replace(" ", "-", $daerah);
                $judul_url2=str_replace(" ", "-", $cari_sesuatu);
                $judul_url=$judul_url0."+".$judul_url1."+".$judul_url2;

                $where= "provinsi='".$provinsi."' and daerah='".$daerah."' and (judul_iklan LIKE "."'%". $cari_sesuatu."%'";
                
            
                $queryString = explode(' ', $cari_sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                   
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_loc_ses/". $judul_url;
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
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
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

                $data['title']=  "Otomotif Store";
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);
            }
        }else{
            redirect(site_url().'search/all');
        }
    }


    function all(){

            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/all/";
            //jumlah total data
              $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan");
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
                $limit=intval($this->uri->segment(3));
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);

    }



    function page_ses(){
        $cari=str_replace("-", " ", $this->uri->segment(3));
         
        $where="judul_iklan LIKE "."'%". $cari."%'";
            $queryString = explode('-', $this->uri->segment(3));
            foreach ($queryString as $key => $value) {
                $where .= " OR judul_iklan LIKE '%".$value."%'";
                $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                
            }
           


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/page_ses/".$this->uri->segment(3)."/";
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
                $limit= intval($this->uri->segment(4)) ;
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);

    }

    function page_prov(){
        $provinsi=str_replace("-", " ", $this->uri->segment(3));
         
        $where= "provinsi='".$provinsi."'";
            


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/page_prov/".$this->uri->segment(3)."/";
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
                $limit= intval($this->uri->segment(4)) ;
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);

    }
    function page_location(){
        $data_lokasi=explode('+',  $this->uri->segment(3));

        $provinsi=str_replace("-", " ", $data_lokasi[0]);
        $daerah=str_replace("-", " ", $data_lokasi[1]);

         
        $where= "provinsi='".$provinsi."' and daerah='".$daerah."'";
            

            


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/page_location/".$this->uri->segment(3)."/";
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
                $limit=intval($this->uri->segment(4)) ;
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);

    }

    function prov_some(){
                $pecah=explode('+',  $this->uri->segment(3));
              
                $provinsi=str_replace("-", " ", $pecah[0]);
                $sesuatu=str_replace("-", " ", $pecah[1]);
                

                $where= "provinsi='".$provinsi."' and (judul_iklan LIKE "."'%".$sesuatu."%'";
                
            
                $queryString = explode(' ', $sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                 
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/prov_some/". $this->uri->segment(3);
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
                    $limit=intval($this->uri->segment(4)) ;
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }

    function page_loc_ses(){

         $pecah=explode('+',  $this->uri->segment(3));
              
                $provinsi=str_replace("-", " ", $pecah[0]);
                $daerah=str_replace("-", " ", $pecah[1]);
                $sesuatu=str_replace("-", " ", $pecah[2]);
                

                $where= "provinsi='".$provinsi."' and daerah='".$daerah."' and (judul_iklan LIKE "."'%".$sesuatu."%'";
                
            
                $queryString = explode(' ', $sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                    
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_loc_ses/". $this->uri->segment(3);
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
                    $limit= intval($this->uri->segment(4)) ;
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }
     function page_prov_cat1(){
        $provinsi=str_replace("-", " ", $this->uri->segment(3));
        $kategori= $this->uri->segment(4);
         
        $where= "provinsi='".$provinsi."' and kategori='".$kategori."' ";
            


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/page_prov_cat1/".$this->uri->segment(3)."/".$kategori;
            //jumlah total data
              $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
            //jumlah data per halaman
            $config['per_page']=9;
            //jumah link no halaman 
            $config['num_links'] = 5;
            //segment URL yang akan dijadikan pemotongan data
            //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
            $config['uri_segment'] = 5;
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
            if ($this->uri->segment(5)==null) {
               
            }else{
                $limit=$this->uri->segment(5);
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }

            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);

    }

    function page_prov_cat2(){
        $data_lokasi=explode('+',  $this->uri->segment(3));

        $provinsi=str_replace("-", " ", $data_lokasi[0]);
        $daerah=str_replace("-", " ", $data_lokasi[1]);
        $kategori=$this->uri->segment(4);

         
        $where= "provinsi='".$provinsi."' and daerah='".$daerah."' and kategori='".$kategori."' ";
            

            


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/page_prov_cat2/".$this->uri->segment(3)."/".$kategori;
            //jumlah total data
              $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
            //jumlah data per halaman
            $config['per_page']=9;
            //jumah link no halaman 
            $config['num_links'] = 5;
            //segment URL yang akan dijadikan pemotongan data
            //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
            $config['uri_segment'] = 5;
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
            if ($this->uri->segment(5)==null) {
               
            }else{
                $limit=$this->uri->segment(5);
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);

    }

     function page_cat_ses(){
                
                $sesuatu=mysql_real_escape_string($this->uri->segment(3));
                $kategori=$this->uri->segment(4);
                

                $where= "kategori='".$kategori."' and (judul_iklan LIKE "."'%".$sesuatu."%'";
                
            
                $queryString = explode(' ', $sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                   
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_cat_ses/". $this->uri->segment(3)."/".$kategori;
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
                //jumlah data per halaman
                $config['per_page']=9;
                //jumah link no halaman 
                $config['num_links'] = 5;
                //segment URL yang akan dijadikan pemotongan data
                //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
                $config['uri_segment'] = 5;
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
                if ($this->uri->segment(5)==null) {
                   
                }else{
                    $limit=$this->uri->segment(5);
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }

    function page_cat_lok_ses1(){
                $pecah=explode('+',  $this->uri->segment(3));
              
                $pp=mysql_real_escape_string($this->uri->segment(4));
                $provinsi=str_replace("-", " ", $pp);
              

                $kategori=mysql_real_escape_string($this->uri->segment(3));
                $sesuatu=mysql_real_escape_string($this->uri->segment(5));
                $where= "provinsi='".$provinsi."' and kategori='".$kategori."' and (judul_iklan LIKE "."'%". $sesuatu."%'";

                
            
                $queryString = explode(' ', $sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                  
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_cat_lok_ses1/$kategori/$pp/$sesuatu";
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
                //jumlah data per halaman
                $config['per_page']=9;
                //jumah link no halaman 
                $config['num_links'] = 5;
                //segment URL yang akan dijadikan pemotongan data
                //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
                $config['uri_segment'] = 6;
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
                if ($this->uri->segment(6)==null) {
                   
                }else{
                    $limit=$this->uri->segment(6);
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }
    function page_cat2(){
                
                $kategori=mysql_real_escape_string($this->uri->segment(3));
                $sub_kategori=mysql_real_escape_string($this->uri->segment(4));
                $judul_urlk=str_replace("-", " ", $sub_kategori);
                

                $where= "kategori='".$kategori."' and sub_kategori='".$judul_urlk."'";
                


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_cat2/". $this->uri->segment(3)."/".$sub_kategori;
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
                //jumlah data per halaman
                $config['per_page']=9;
                //jumah link no halaman 
                $config['num_links'] = 5;
                //segment URL yang akan dijadikan pemotongan data
                //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
                $config['uri_segment'] = 5;
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
                if ($this->uri->segment(5)==null) {
                   
                }else{
                    $limit=$this->uri->segment(5);
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }
    function page_cat2_wil1(){
        $provinsi=str_replace("-", " ", $this->uri->segment(3));
        $kategori= mysql_real_escape_string($this->uri->segment(4));
        $subkategori= mysql_real_escape_string($this->uri->segment(5));
        $sub_kategori=str_replace("-", " ", $subkategori);
         
        $where= "provinsi='".$provinsi."' and kategori='".$kategori."' and sub_kategori='".$sub_kategori."'";
            


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/page_cat2_wil1/".$this->uri->segment(3)."/".$kategori."/".$this->uri->segment(5);
            //jumlah total data
              $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
            //jumlah data per halaman
            $config['per_page']=9;
            //jumah link no halaman 
            $config['num_links'] = 5;
            //segment URL yang akan dijadikan pemotongan data
            //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
            $config['uri_segment'] = 6;
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
            if ($this->uri->segment(6)==null) {
               
            }else{
                $limit=$this->uri->segment(6);
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }

            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);

    }
    function page_cat2_wil2(){
        $data_lokasi=explode('+',  $this->uri->segment(3));

        $provinsi=str_replace("-", " ", $data_lokasi[0]);
        $daerah=str_replace("-", " ", $data_lokasi[1]);
        $kategori=$this->uri->segment(4);
        $subkategori=mysql_real_escape_string($this->uri->segment(5));
        $sub_kategori=str_replace("-", " ", $subkategori);

         
        $where= "provinsi='".$provinsi."' and daerah='".$daerah."' and kategori='".$kategori."' and sub_kategori='".$sub_kategori."'";
            

            


            $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."search/page_cat2_wil2/".$this->uri->segment(3)."/".$kategori."/".$this->uri->segment(5);
            //jumlah total data
              $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
            //jumlah data per halaman
            $config['per_page']=9;
            //jumah link no halaman 
            $config['num_links'] = 5;
            //segment URL yang akan dijadikan pemotongan data
            //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
            $config['uri_segment'] = 6;
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
            if ($this->uri->segment(6)==null) {
               
            }else{
                $limit=$this->uri->segment(6);
            }
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php

            $data['title']=  "Otomotif Store";
            if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
            $this->load->view('head',$data);
            $this->load->view('view_search',$data);
            $this->load->view('footer',$data);

    }
    function page_cat2_ses(){
                
                $sesuatu=mysql_real_escape_string($this->uri->segment(3));
                $kategori=$this->uri->segment(4);
                $subkategori=mysql_real_escape_string($this->uri->segment(5));
                $sub_kategori=str_replace("-", " ", $subkategori);
                

                $where= "kategori='".$kategori."' and sub_kategori='".$sub_kategori."' and (judul_iklan LIKE "."'%".$sesuatu."%'";
                
            
                $queryString = explode(' ', $sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                   
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_cat2_ses/". $this->uri->segment(3)."/".$kategori."/".$this->uri->segment(5);
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
                //jumlah data per halaman
                $config['per_page']=9;
                //jumah link no halaman 
                $config['num_links'] = 5;
                //segment URL yang akan dijadikan pemotongan data
                //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
                $config['uri_segment'] = 6;
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
                if ($this->uri->segment(6)==null) {
                   
                }else{
                    $limit=$this->uri->segment(6);
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }
     function page_cat2_lok_ses1(){
                $pecah=explode('+',  $this->uri->segment(3));
              
                $pp=mysql_real_escape_string($this->uri->segment(4));
                $provinsi=str_replace("-", " ", $pp);
              

                $kategori=mysql_real_escape_string($this->uri->segment(3));
                $sesuatu=mysql_real_escape_string($this->uri->segment(5));
                $subkategori=mysql_real_escape_string($this->uri->segment(6));
                $sub_kategori=str_replace("-", " ", $subkategori);
                $where= "provinsi='".$provinsi."' and kategori='".$kategori."' and sub_kategori='".$sub_kategori."' and (judul_iklan LIKE "."'%". $sesuatu."%'";

                
            
                $queryString = explode(' ', $sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                    
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_cat_lok_ses1/$kategori/$pp/$sesuatu";
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
                //jumlah data per halaman
                $config['per_page']=9;
                //jumah link no halaman 
                $config['num_links'] = 5;
                //segment URL yang akan dijadikan pemotongan data
                //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
                $config['uri_segment'] = 7;
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
                if ($this->uri->segment(7)==null) {
                   
                }else{
                    $limit=$this->uri->segment(7);
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }

    function page_cat1_lok_ses2(){
                $pecah=explode('+',  $this->uri->segment(3));
              
                $pp=mysql_real_escape_string($this->uri->segment(4));
                $provinsi=str_replace("-", " ", $pp);
              

                $kategori=mysql_real_escape_string($this->uri->segment(3));
                $sesuatu=mysql_real_escape_string($this->uri->segment(5));
                $daerah=mysql_real_escape_string($this->uri->segment(6));
                $sub_daerah=str_replace("-", " ", $daerah);
                $where= "provinsi='".$provinsi."' and daerah='".$sub_daerah."' and kategori='".$kategori."' and (judul_iklan LIKE "."'%". $sesuatu."%'";

                
            
                $queryString = explode(' ', $sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                    
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_cat1_lok_ses2/$kategori/$pp/$sesuatu/".$this->uri->segment(6);
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
                //jumlah data per halaman
                $config['per_page']=9;
                //jumah link no halaman 
                $config['num_links'] = 5;
                //segment URL yang akan dijadikan pemotongan data
                //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
                $config['uri_segment'] = 7;
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
                if ($this->uri->segment(7)==null) {
                   
                }else{
                    $limit=$this->uri->segment(7);
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }
    function page_cat2_lok_ses2(){
                $pecah=explode('+',  $this->uri->segment(3));
              
                $pp=mysql_real_escape_string($this->uri->segment(4));
                $provinsi=str_replace("-", " ", $pp);
              

                $kategori=mysql_real_escape_string($this->uri->segment(3));
                $sesuatu=mysql_real_escape_string($this->uri->segment(5));
                $daerah=mysql_real_escape_string($this->uri->segment(6));
                $sub_daerah=str_replace("-", " ", $daerah);
                $subkategori=mysql_real_escape_string($this->uri->segment(7));
                $sub_kategori=str_replace("-", " ", $subkategori);
                $where= "provinsi='".$provinsi."' and daerah='".$sub_daerah."' and kategori='".$kategori."' and sub_kategori='".$sub_kategori."' and (judul_iklan LIKE "."'%". $sesuatu."%'";

                
            
                $queryString = explode(' ', $sesuatu);
                foreach ($queryString as $key => $value) {
                    $where .= " OR judul_iklan LIKE '%".$value."%'";
                    $where .= " OR deskripsi_iklan LIKE '%".$value."%'" ;
                 
                }
                 $where .=")" ;


                $this->load->library('pagination');
                $this->load->library('table');

                $config['base_url'] = base_url()."search/page_cat2_lok_ses2/$kategori/$pp/$sesuatu/".$this->uri->segment(6)."/".$this->uri->segment(7);
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From iklan where " . $where);
                //jumlah data per halaman
                $config['per_page']=9;
                //jumah link no halaman 
                $config['num_links'] = 5;
                //segment URL yang akan dijadikan pemotongan data
                //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
                $config['uri_segment'] = 8;
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
                if ($this->uri->segment(8)==null) {
                   
                }else{
                    $limit=$this->uri->segment(8);
                }
                $data['produk'] = $this->model_global->data_paging("SELECT * FROM iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");
    // kirim data dan hasil paging ke file application/views/v_produk.php
                if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_global->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $data['title']=  "Otomotif Store";
                $data['prov']=$this->model_global->query_getAll("SELECT * From provinsi");
                $this->load->view('head',$data);
                $this->load->view('view_search',$data);
                $this->load->view('footer',$data);

    }
    function data_kategori(){
        $id_kategori=$this->input->post('id_kategori');
        $kategori=$this->input->post('nama_kategori');
        $data=$this->model_global->query_getAll("SELECT * From sub_kategori where id_kategori=$id_kategori");
        
        echo '<div>- Pilih Sub Kategori - </div><a class="list-group-item active" style="text-align:center; background-color:#00cc44;" >kategori : '. $kategori.'</a>';
        echo ' <a href="#" class="list-group-item" onclick="add_modal_sub_kategori(\''.''.'\')">Pilih Semua kategori '.$kategori.'</a>';
        foreach ($data as $key) {
           echo ' <a href="#" class="list-group-item" onclick="add_modal_sub_kategori(\''.'->'.$key->nama_sub_kategori.'\')">'.$key->nama_sub_kategori.'</a>';
        }
    }
















        
      
}
?>
