<?php

class Mahasiswa extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_mahasiswa');
        }

        function index(){
            $data['data']=  $this->model_mahasiswa->getAll();
            $this->load->view('view_mahasiswa',$data);
        }
        
        function register_member(){
            $dataInsert=array(
                'nama'=>  $this->input->post('nama'),
                'email'=>  $this->input->post('email'),
                'password'=> $this->input->post('alamat'),
                'level'=> 'member'
            );
            $this->model_mahasiswa->insert($dataInsert);
            redirect('home');
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
