<?php

/**
 * 
 * this class using for creating 
 * table based on text for
 * dot matrix printer
 * 
 * @author apelweb.com
 * @copyright Wildan Afif Abidullah
 * @since 10 Okt 2015 01:03
 * @version 1.0.0
 * @license -
 * 
 * @example
 *
 *
 * 
 * 
 * ---------------------------------------------------------------------------------------------------------
 * |                                                                                                       |
 * |                                            DAFTAR AMGGOTA                                             |
 * |                                                                                                       |
 * ---------------------------------------------------------------------------------------------------------
 * |No.  |              NAMA               |                   POSISI                   |   ORGANIZATIONS  |
 * ---------------------------------------------------------------------------------------------------------
 * |1.   |WILDAN AFIF A                    |    PROJECT MANAJER , ANALIS , PROGRAMMER   |APELWEB, WIRESTARK|
  *      |                                 |                                            |     INDONESIA    |
 * |     |                                 |                                            |                  |
 * |2.   |DION CHRISTHOPER LIONEL          |DESAIN MOCK UP ,DESAIN REQUIREMENT, ANALIS 2|      APELWEB     |
 * |     |                                 |                                            |                  |
 * |3.   |NABILA                           |           DOKUMENTASI , TESTING            |       ----       |
 * |     |                                 |                                            |                  |
 * ---------------------------------------------------------------------------------------------------------
 * |TOTAL|                                                                                         3 Orang |
 * ---------------------------------------------------------------------------------------------------------
 * |                                            FREE MAINTENANCE                                           |
 * ---------------------------------------------------------------------------------------------------------
 * 
 */

class Model_global extends CI_Model {

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

     function query_for_control($qury_eks) {
     

        $query = $this->db->query($qury_eks);
        $row = $query->row_array();
        return $row;
        // foreach ($query->result_array() as $row)
        // {


        //    return $row['id_iklan'];
          
        // }
       
    }

    public function cek_id_transaksi($data) {
            $query = $this->db->get_where('transakasi_keuangan', $data);
            return $query;
        }

    function query_insert($data) {
       $query = $this->db->query($data);
    }

    function insert($data) {
        $insert = $this->db->insert('posting', $data); //nama tabel, terus data yang mo di masukkan
        return $insert;
    }

    function total_paging($query){
        $sql_query=$this->db->query($query); 
        return $sql_query->num_rows();
    }

    function data_paging($query){
        $this->db->order_by("id_iklan", "desc");  
        $sql_query=$this->db->query($query); 
            if($sql_query->num_rows()>0){
                return $sql_query->result_array();
            }
    }   

    

    public function TotalPosting() {
    $sql_query=$this->db->get('posting'); 
    return $sql_query->num_rows();
    }

    public function TotalPosting_kategori($kategori) {
    $sql_query=$this->db->get_where('posting', array('kategori' => $kategori)); 
    return $sql_query->num_rows();
    }

    public function Tampilkategori($perPage, $uri) {
        
    $this->db->order_by("id_iklan", "desc");  
    $sql_query=$this->db->get('iklan',$perPage, $uri); 
            if($sql_query->num_rows()>0){
                return $sql_query->result_array();
            }
    }   
     public function TampilPosting_kategori($perPage, $uri ,$kategori) {
   // $this->db->where('posting', array('kategori' => 'Entertainment'));  
    $this->db->order_by("id_posting", "desc");  
    $sql_query=$this->db->get_where('posting', array('kategori' => $kategori),$perPage, $uri); 
            if($sql_query->num_rows()>0){
                return $sql_query->result_array();
            }
    }   







function cek_user($data) {
            $query = $this->db->get_where('user', $data);
            return $query;
        }



    function update($id, $data) {
        $this->db->where('nim', $id);
        $update = $this->db->update('mahasiswa', $data);
        return $update;
    }

    function delete($id) {
        $this->db->where('nim', $id);
        $delete = $this->db->delete('mahasiswa');
        return $delete;
    }

    function getAll() {
        $query = $this->db->get('mahasiswa');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
   
    function get_by_id($id){
        $this->db->where('nim',$id);
        $query=$this->db->get('mahasiswa');
        return $query->result();
    }

}

?>
