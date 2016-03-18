<?php

class Model_user extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function cek_user($data) {
            $query = $this->db->get_where('user', $data);
            return $query;
    }


    function register_member($data) {
        $insert = $this->db->insert('user', $data); //nama tabel, terus data yang mo di masukkan
        return $insert;
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
    function query_insert($data) {
       $query = $this->db->query($data);
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
