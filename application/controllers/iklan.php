<?php

class Iklan extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->model('model_iklan');
        }


        function index(){
            
            if($this->input->post('pasang')){
                include('class.uploader.php');
                include('watermark.php');
                $nego=0;
                if ($this->input->post('nego')) {
                   $nego=1;
                };
             $wa=0;
                if ($this->input->post('wa')) {
                   $wa=1;
                };


            if ($this->input->post('pin_bb')=='') {
                $pin_bb="tidak ada";
            }else{
                $pin_bb=$this->input->post('pin_bb');
            }
            $data_kategori = $this->model_iklan->query_for_control("SELECT * from kategori where id_kategori=".$this->input->post('kategori'));
             $data_prov = $this->model_iklan->query_for_control("SELECT * from provinsi where id_provinsi=".$this->input->post('provinsi'));

            
             if ($this->input->post('harga_mobile')!='') {
                $harga_item_lain=$this->input->post('harga_mobile');
             }else{
                 $str =$this->input->post('harga');
                 $hr=explode(" ",$str);
                 $min_koma=explode(",",$hr[1]);
                 $hrga=explode(".", $min_koma[0]);
                 $harga_fix='';
                 foreach ($hrga as $key => $value) {
                      $harga_fix .= $value;
                  }

                 $harga_item_lain=intval($harga_fix) ;
             }

             if (isset($_SESSION['id_user'])) {
                $id_user=$_SESSION['id_user'];
                $registered=1;

             }else{
                $id_user=0;
                $registered=0;

             }
             date_default_timezone_set("Asia/Jakarta");
    
            $tgl_sekarang= date("Y-m-d G:i:s");

                 $wkt = time();
                        $dataInsert=array(
                            'kondisi'=>  $this->input->post('kondisi'),
                            'judul_iklan'=>  $this->input->post('judul_iklan'),
                            'kategori'=>   $data_kategori['nama_kategori'],
                            'deskripsi_iklan'=> $this->input->post('deskripsi_iklan'),
                            'harga'=>$harga_item_lain,
                            'provinsi'=> $data_prov['nama_provinsi'],
                            'nama'=> $this->input->post('nama'),
                            '`telp'=> $this->input->post('telp'),
                            'pin_bb'=> $pin_bb,
                            'waktu'=> $wkt,
                            'daerah'=>$this->input->post('daerah'),
                            'nego'=>$nego,
                            'sub_kategori'=>$this->input->post('sub_kategori'),
                            'mail'=>$this->input->post('maile'),
                            'user_register'=>$registered,
                            'id_user'=>$id_user,
                            'wa'=>$wa,
                            'tgl'=>$tgl_sekarang
                        );
                        $id_iklan=$this->model_iklan->insert($dataInsert);
                
                $uploader = new Uploader();
                $data = $uploader->upload($_FILES['files'], array(
                    'limit' => 10, //Maximum Limit of files. {null, Number}
                    'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
                    'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
                    'required' => false, //Minimum one file is required for upload {Boolean}
                    'uploadDir' => 'uploads/', //Upload directory {String}
                    'title' => array('auto', 10), //New file name {null, String, Array} *please read documentation in README.md
                    'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
                    'perms' => null, //Uploaded file permisions {null, Number}
                    'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
                    'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
                    'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
                    'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
                    'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
                    'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
                ));
                
                if($data['isComplete']){
                    $files = $data['data'];
                    if (!isset($files['files'][0])) {
                         $dataInsert_img1=array(
                                        'id_iklan'=>  $id_iklan['id_iklan'],
                                        'url_foto_iklan'=> 'uploads/images_non.jpg'
                                    );
                        $data['title']=  "Iklan";
                        $data['url']=site_url()."iklan/view/".$id_iklan['id_iklan']."/".$id_iklan['waktu'];

                         $data['kategori']=  $this->model_iklan->getAll_kategori();
                          if (isset($_SESSION['id_user'])) {
                              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                            }
                        $this->load->view('head',$data);
                        $this->load->view('view_sukses_iklan');
                        $this->load->view('footer');
                        $this->model_iklan->insert_image($dataInsert_img1);
                        $this->model_iklan->query_insert('UPDATE `iklan` SET `temp_foto`="uploads/images_non.jpg" where id_iklan='.$id_iklan['id_iklan']);
                                  

                        
                    }else{ 
                       
                        $path = "uploads/";   // folder upload gambar setelah proses watermark
                        $result = count ($files['files']);          

                          for ($i=0; $i <$result ; $i++) { 
                              if ($files['metas'][$i]['extension']=='png') {
                                    $imag=$files['files'][$i];
                                    $new_name = $path.time().$i.".png";
                                    watermark_image_png($imag , $new_name);
                                    $dataInsert_img=array(
                                        'id_iklan'=>  $id_iklan['id_iklan'],
                                        'url_foto_iklan'=> $new_name
                                    );
                              }elseif ($files['metas'][$i]['extension']=='jpg') {
                                    $imag=$files['files'][$i];
                                    $new_name = $path.time().$i.".jpg";
                                    watermark_image_jpg($imag , $new_name); 
                                    $dataInsert_img=array(
                                        'id_iklan'=>  $id_iklan['id_iklan'],
                                        'url_foto_iklan'=> $new_name
                                    );
                                      ;
                                  }//echo $new_name."<br>";
                                if ($i==0) {
                                    $this->model_iklan->query_insert('UPDATE `iklan` SET `temp_foto`="'.$new_name.'" where id_iklan='.$id_iklan['id_iklan']);

                                }
                                $this->model_iklan->insert_image($dataInsert_img);
                          }

                            $data['title']=  "Iklan";
                            $data['url']=site_url()."iklan/view/".$id_iklan['id_iklan']."/".$id_iklan['waktu'];
                            $data['kategori']=  $this->model_iklan->getAll_kategori();
                             if (isset($_SESSION['id_user'])) {
                              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                            }
                            $this->load->view('head',$data);
                            $this->load->view('view_sukses_iklan');
                            $this->load->view('footer');
                    ;

        }
                   
                }

                if($data['hasErrors']){
                    $errors = $data['errors'];
                    print_r($errors);
                }
            }else{

                $data['meta']['keywords']="Pasang Iklan di otomotifstore";
                $data['data']=  $this->model_iklan->getAll_prov();
                 $data['kategori']=  $this->model_iklan->getAll_kategori();
                $data['title']=  "Pasang Iklan";
                 if (isset($_SESSION['id_user'])) {
                  $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                }
                $this->load->view('head',$data);
                $this->load->view('view_iklan',$data);
                $this->load->view('footer');
                
            }
            

        }

        function view_daerah(){

            if(!empty($_POST["country_id"])) {
                    $id=$_POST["country_id"];
                    $results['data']=$this->model_iklan->get_by_id_daerah($id);
                   // echo "SELECT * from daerah where id_provinsi=$id";
                   
                echo ' <option value="">-Pilih Kab / Kota-</option>';
                   
                
                    foreach($results['data'] as $state) {

                        echo '<option>'.$state->nama_daerah.'</option>';
                
                   
                    }
                }else{
                    echo "gagal";
                }
            
        }

          function view_sub_kategori(){

            if(!empty($_POST["id_sub"])) {
                    $id=$_POST["id_sub"];
                    $results['data']=$this->model_iklan->get_by_id_kategori($id);
                   // echo "SELECT * from daerah where id_provinsi=$id";
                   
                echo ' <option value="">-Pilih Sub Kategori-</option>';
                   
                
                    foreach($results['data'] as $state) {

                        echo '<option>'.$state->nama_sub_kategori.'</option>';
                
                   
                    }
                }else{
                    echo "gagal";
                }
            
        }
        

        
        function view(){
            $id=intval($this->uri->segment(3));
            $this->model_iklan->query_insert("UPDATE `iklan` SET `dilihat`=dilihat+1 WHERE id_iklan=".$id);
            
            $data['iklan']=$this->model_iklan->query_for_control("SELECT * From iklan where id_iklan=".$id);
            $data['foto']=$this->model_iklan->get_by_id_foto($id);
            $data['kategori']=  $this->model_iklan->getAll_kategori();
            if (!isset($data['iklan']['judul_iklan'])) {
               redirect(site_url());
            }
            $data['title']=  $data['iklan']['judul_iklan'];
             if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            $data['meta']['keywords']=$data['iklan']['judul_iklan'];
            $data['id']=$id;
            $this->load->view('head',$data);
            $this->load->view('view_iklan_detail',$data);
            $this->load->view('footer');
            
        }

        function show_image(){
            $id=$this->uri->segment(3);
            $this->model_iklan->query_insert("UPDATE `iklan` SET `dilihat`=dilihat+1 WHERE id_iklan=".$id);
            $data['iklan']=$this->model_iklan->query_for_control("SELECT * From iklan where id_iklan=".$id);
            $data['foto']=$this->model_iklan->get_by_id_foto($id);
            $data['kategori']=  $this->model_iklan->getAll_kategori();
            $data['title']=  $data['iklan']['judul_iklan'];



            $where= " id_iklan=$id ";

           $this->load->model('model_global');
            $this->load->library('pagination');
            $this->load->library('table');  

                $config['base_url'] = base_url()."iklan/show_image/".$id;
                //jumlah total data
                  $config['total_rows'] = $this->model_global->total_paging("SELECT * From foto_iklan where " . $where);
                //jumlah data per halaman
                $config['per_page']=1;
                //jumah link no halaman 
                $config['num_links'] = 2;
                //segment URL yang akan dijadikan pemotongan data
                //baca di http://ozs.web.id/2014/08/membuat-url-dengan-class-url-di-codeigniter/
                $config['uri_segment'] = 4;
                // awal membuka penomoran 
                // menggunakan class bootstrap
               
                // akhi membuka penomoran 
                
               
            //class bootstrap untuk awal halaman
                $config['first_link']='<span class="">Gambar Sebelumnya</span>';
            //class bootstrap untuk akhir halaman
                $config['last_link']='<span class="">Gambar Selanjutnya</span>';
            //class bootstrap untuk  halaman berikutnya
                $config['next_link']='<span class="">Gambar Selanjutnya</span>';
            //class bootstrap untuk  halaman sebelumnya
                $config['prev_link']='<span class="">Gambar Sebelumnya</span>';
        // inisialisasi paging
                $this->pagination->initialize($config);
        // membuat paging dan disimpan dalam array $halaman
                $data['halaman']=$this->pagination->create_links();
        // mengambil data per halaman
                $limit=0;
                if ($this->uri->segment(4)==null) {
                   
                }else{
                    $limit=$this->uri->segment(4);
                }
  
 









             if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
            
            $data['produk'] = $this->model_global->data_paging("SELECT * FROM foto_iklan where ".$where." LIMIT "."$limit".",".$config['per_page']."");

            $this->load->view('head',$data);
            $this->load->view('view_iklan_show_image',$data);
            $this->load->view('footer');
            
        }


        function iklan_kategori(){

        $this->load->library('pagination');
        $this->load->library('table');

        $config['base_url'] = base_url()."iklan/iklan_kategori";
        //jumlah total data
          $config['total_rows'] = $this->model_iklan->TotalPosting_kategori($this->uri->segment(4));
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
        $data['produk'] = $this->model_iklan->TampilPosting_kategori($config['per_page'], $this->uri->segment(3) , $this->uri->segment(4));
// kirim data dan hasil paging ke file application/views/v_produk.php
        $data['kategori']=  $this->model_iklan->getAll_kategori();
        $data['title']=  "Otomotif Store";
         if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
        $this->load->view('head',$data);
        $this->load->view('view_kategori',$data);
        $this->load->view('footer');

            
        }
        function c(){
            
            $id_user=abs((int)$this->uri->segment(3));
           $data['user']=$this->model_iklan->query_for_control("SELECT * From user where id_user=".$id_user);
           if (!isset($data['user']['id_user'])) {
               redirect(site_url());    
           }
             $this->load->library('pagination');
            $this->load->library('table');

            $config['base_url'] = base_url()."iklan/c/".$id_user;
            //jumlah total data
              $config['total_rows'] = $this->model_iklan->Total_iklan_detail($id_user);
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
            $data['produk'] = $this->model_iklan->Tampil_iklan_user($config['per_page'], $this->uri->segment(4) , $id_user);
    // kirim data dan hasil paging ke file application/views/v_produk.php
            $data['kategori']=  $this->model_iklan->getAll_kategori();
            $data['title']=  "Otomotif Store";
             if (isset($_SESSION['id_user'])) {
              $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

            }
           $data['prov']=$this->model_iklan->query_getAll("SELECT * From provinsi");

            $this->load->view('head',$data);
            $this->load->view('view_iklan_member_detail',$data);
            $this->load->view('footer',$data);


        }

    function edit_iklan(){

        if ($this->input->post('submit')) {
            $id_iklan=abs((int)$this->input->post('id_iklan'));


            
            $harga_item_lain=$this->input->post('harga');

            

            if ($this->input->post('pin_bb')=='') {
                $pin_bb="tidak ada";
            }else{
                $pin_bb=$this->input->post('pin_bb');
            }
            $nego=0;
            if ($this->input->post('nego')) {
               $nego=1;
            };
            $wa=0;
            if ($this->input->post('wa')) {
                $wa=1;
            };

            $data_kategori = $this->model_iklan->query_for_control("SELECT * from kategori where id_kategori=".$this->input->post('kategori'));
            $data_prov = $this->model_iklan->query_for_control("SELECT * from provinsi where id_provinsi=".$this->input->post('provinsi'));


             $data_update=array(
                            'kondisi'=>  $this->input->post('kondisi'),
                            'judul_iklan'=>  $this->input->post('judul_iklan'),
                            'kategori'=>   $data_kategori['nama_kategori'],
                            'deskripsi_iklan'=> $this->input->post('deskripsi_iklan'),
                            'harga'=>$harga_item_lain,
                            'provinsi'=> $data_prov['nama_provinsi'],
                            'nama'=> $this->input->post('nama'),
                            '`telp'=> $this->input->post('telp'),
                            'pin_bb'=> $pin_bb,
                            
                            'daerah'=>$this->input->post('daerah'),
                            'nego'=>$nego,
                            'sub_kategori'=>$this->input->post('sub_kategori'),
                            'mail'=>$this->input->post('maile'),
                            
                            'wa'=>$wa
            );
             if ($this->model_iklan->update($id_iklan,$data_update)) {
                if ($data['iklan']=$this->model_iklan->query_for_control("SELECT * From iklan WHERE id_iklan=$id_iklan")) {
                    $data['sukses_edit']=1;
                    $data['kategori']=  $this->model_iklan->query_getAll("SELECT * from kategori");
                    $data['provinsi']=  $this->model_iklan->query_getAll("SELECT * from provinsi");
                    $data['title']=  $data['iklan']['judul_iklan'];
                     if (isset($_SESSION['id_user'])) {
                      $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                    }
                    $this->load->view('head',$data);
                    $this->load->view('view_edit_iklan',$data);
                    $this->load->view('footer');
                }else{
                    redirect('error');
                }
                     //redirect('iklan/edit_iklan/$id_iklan/'.$this->uri->segment(3));
             }
        }else{
            
            $id_iklan = abs((int)$this->uri->segment(3));
            if ($data['iklan']=$this->model_iklan->query_for_control("SELECT * From iklan WHERE id_iklan=$id_iklan")) {
                $data['kategori']=  $this->model_iklan->query_getAll("SELECT * from kategori");
                $data['provinsi']=  $this->model_iklan->query_getAll("SELECT * from provinsi");
                $data['title']=  $data['iklan']['judul_iklan'];
                 if (isset($_SESSION['id_user'])) {
                      $data['favorit']=$this->model_iklan->query_for_control("SELECT count(id_favorite) as favorit from favorite where id_user=".$_SESSION['id_user']);

                    }
                $this->load->view('head',$data);
                $this->load->view('view_edit_iklan',$data);
                $this->load->view('footer');
            }else{
                redirect('error');
            }
        }


    }
    function hapus_iklan(){
        if (isset($_SESSION['id_user'])) {
            $id_iklan=mysql_real_escape_string($this->uri->segment(3));
            echo $id_iklan;
            $this->model_iklan->query_insert("DELETE From foto_iklan where id_iklan=$id_iklan");
            $this->model_iklan->query_insert("DELETE From iklan where id_iklan=$id_iklan");
            $_SESSION['hapus']=1;
            redirect(site_url()."iklansaya/");
            
        }else{
            redirect(site_url());
        }
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
