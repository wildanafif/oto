<?php

class Search_m extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        
        }

    function index(){
       
    }
    function get_data_daerah(){
        $id=$this->input->post('id_provinsi');
        $data=$this->model_global->query_getAll("SELECT * From daerah where id_provinsi=$id");

        if ($this->input->post('id_provinsi')==0) {
                 
        }else{
            echo '<select class="form-control" name="daerah" > <option value="">-Pilih daerah-</option>';
            foreach ($data as $key) {
                echo '<option value="'.$key->nama_daerah.'" >'.$key->nama_daerah.'</option>';
            }
            echo '</select>';
        }       
                
        
    }

    function cari(){
        //provinsi ada yang lain tidak
        if ($this->input->get('provinsi')!=0 && $this->input->get('daerah')=='' && $this->input->get('sesuatu')=='') {
           $id_provinsi=mysql_real_escape_string($this->input->get('provinsi'));
           $provinsi=$this->model_global->query_for_control("SELECT * From provinsi where id_provinsi=$id_provinsi");
           $prov_parse=str_replace(" ", "+", $provinsi['nama_provinsi']);
           redirect(site_url().'search/search_?wilayah='.$prov_parse.'&sesuatu=');

        //provinsis ada dan daerah ada
        }elseif ($this->input->get('provinsi')!=0 && $this->input->get('daerah')!='' && $this->input->get('sesuatu')=='') {
            $daerah=mysql_real_escape_string($this->input->get('daerah'));
            $id_provinsi=mysql_real_escape_string($this->input->get('provinsi'));
            $provinsi=$this->model_global->query_for_control("SELECT * From provinsi where id_provinsi=$id_provinsi");
            //http://localhost/project/oto/search/search_?wilayah=Jawa+Timur-%3ETuban+Kab.&sesuatu=
            $prov_parse=str_replace(" ", "+", $provinsi['nama_provinsi']);
            $daerah_parse=str_replace(" ", "+", $daerah);
            $wilayah=$prov_parse."->".$daerah_parse;
            redirect(site_url().'search/search_?wilayah='.$wilayah);
            
        //provinsi tak ada dan daerah tidak ada , sesuatu ada
        }elseif ($this->input->get('provinsi')==0 && $this->input->get('daerah')=='' && $this->input->get('sesuatu')!='') {
            $sesuatu=mysql_real_escape_string($this->input->get('sesuatu'));
            redirect(site_url().'search/search_?wilayah=&sesuatu='.$sesuatu);

        //provinsi ada dan daerah tidak ada , sesuatu ada
        }elseif ($this->input->get('provinsi')!=0 && $this->input->get('daerah')=='' && $this->input->get('sesuatu')!='') {
            $id_provinsi=mysql_real_escape_string($this->input->get('provinsi'));
            $sesuatu=mysql_real_escape_string($this->input->get('sesuatu'));
            $provinsi=$this->model_global->query_for_control("SELECT * From provinsi where id_provinsi=$id_provinsi");
            //http://localhost/project/oto/search/search_?wilayah=Jawa+Timur&sesuatu=velg
            $prov_parse=str_replace(" ", "+", $provinsi['nama_provinsi']);
            redirect(site_url().'search/search_?wilayah='.$prov_parse.'&sesuatu='.$sesuatu);
          

        //provinsi ada dan daerah  ada , sesuatu ada
        }elseif ($this->input->get('provinsi')!=0 && $this->input->get('daerah')!='' && $this->input->get('sesuatu')!='') {
            $id_provinsi=mysql_real_escape_string($this->input->get('provinsi'));
            $daerah=mysql_real_escape_string($this->input->get('daerah'));
            $sesuatu=mysql_real_escape_string($this->input->get('sesuatu'));
            $provinsi=$this->model_global->query_for_control("SELECT * From provinsi where id_provinsi=$id_provinsi");
            //http://localhost/project/oto/search/search_?wilayah=Jawa+Timur-%3EBangkalan+Kab.&sesuatu=judul+iklan
            $prov_parse=str_replace(" ", "+", $provinsi['nama_provinsi']);
            $daerah_parse=str_replace(" ", "+", $daerah);
            $wilayah=$prov_parse."->".$daerah_parse;
            redirect(site_url().'search/search_?wilayah='.$wilayah.'&sesuatu='.$sesuatu);
            
        }else{
            redirect(site_url().'search/all');
        }
    }

        

       
}
?>
