<?php

class Model_mahasiswa extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data) {
        $insert = $this->db->insert('mahasiswa', $data); //nama tabel, terus data yang mo di masukkan
        return $insert;
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
