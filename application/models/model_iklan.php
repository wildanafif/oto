<?php

class Model_iklan extends CI_Model {

    function __construct() {
        parent::__construct();
    }
     function query_getAll($queryku) {
        $query = $this->db->query($queryku);
     
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    function cek_boolean($data,$tabel){

         $query = $this->db->get_where($tabel, $data);
         return $query;
    }
 function query_for_control($qury_eks) {
     

        $query = $this->db->query($qury_eks);
        $row = $query->row_array();
        return $row;
        // foreach ($query->result_array() as $row)
        // {


        //    return $row['id_iklan'];
          
        // }
       
    }
    public function TotalPosting_kategori($kategori) {
    $sql_query=$this->db->get_where('iklan', array('kategori' => $kategori)); 
    return $sql_query->num_rows();
    }


    public function TampilPosting_kategori($perPage, $uri ,$kategori) {
   // $this->db->where('posting', array('kategori' => 'Entertainment'));  
        $this->db->order_by("id_iklan", "desc");  
        $sql_query=$this->db->get_where('iklan', array('kategori' => $kategori),$perPage, $uri); 
                if($sql_query->num_rows()>0){
                    return $sql_query->result_array();
                }
    } 

    public function Total_iklan_detail($id_user) {
    $sql_query=$this->db->get_where('iklan', array('id_user' => $id_user)); 
    return $sql_query->num_rows();
    }


    public function Tampil_iklan_user($perPage, $uri ,$id_user) {
   // $this->db->where('posting', array('kategori' => 'Entertainment'));  
        $this->db->order_by("id_iklan", "desc");  
        $sql_query=$this->db->get_where('iklan', array('id_user' => $id_user),$perPage, $uri); 
                if($sql_query->num_rows()>0){
                    return $sql_query->result_array();
                }
    } 

    function insert($data) {
        $insert = $this->db->insert('iklan', $data);

        $query = $this->db->query("SELECT * from iklan where  judul_iklan='".$data['judul_iklan']."' and nama='".$data['nama']."' and deskripsi_iklan='".$data['deskripsi_iklan']."' and waktu='".$data['waktu']."'");
        $row = $query->row_array();
        return $row;
        // foreach ($query->result_array() as $row)
        // {


        //    return $row['id_iklan'];
          
        // }
       
    }

     function insert_image($data) {
        $insert = $this->db->insert('foto_iklan', $data);

      
       
    }

    function update($id, $data) {
        $this->db->where('id_iklan', $id);
        $update = $this->db->update('iklan', $data);
        return $update;
    }

    function delete($id) {
        $this->db->where('nim', $id);
        $delete = $this->db->delete('mahasiswa');
        return $delete;
    }

    function getAll_prov() {
        $query = $this->db->get('provinsi');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    function getAll_kategori() {
        $query = $this->db->get('kategori');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
   
    function get_by_id($id){
        //SELECT * from kategori k , iklan i , sub_kategori s where i.id_iklan=$id and i.kategori=k.id_kategori and i.sub_kategori=s.id_sub_kategori
        $query = $this->db->query("SELECT * from iklan i, provinsi p , kategori k  where i.id_iklan=$id and i.provinsi=p.id_provinsi and i.kategori=k.id_kategori");
        // echo "SELECT * from iklan where id_iklan=$id";
        echo "";
        $row = $query->row_array();
        return $row;
    }

     function get_by_id_daerah($id){
        $query = $this->db->query("SELECT * from daerah where id_provinsi=$id");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }

        // echo "SELECT * from iklan where id_iklan=$id";
        
    }
     function get_by_id_kategori($id){
        $query = $this->db->query("SELECT * from sub_kategori where id_kategori=$id");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }

        // echo "SELECT * from iklan where id_iklan=$id";
        
    }



      function get_by_id_foto($id){
        $query = $this->db->query("SELECT * from foto_iklan where id_iklan=$id");

       
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

     function query_insert($query){
       $this->db->query($query);

       
    }

    public function TotalProduk() {
    $sql_query=$this->db->get('iklan'); 
    return $sql_query->num_rows();
    }

    
    public function TampilProduk($perPage, $uri) {
        
    $sql_query=$this->db->get('iklan',$perPage, $uri);  
            if($sql_query->num_rows()>0){
                return $sql_query->result_array();
            }
    }   


}

?>
