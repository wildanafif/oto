<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_user');
        session_start();
        }

        function index(){
            $data['data']=  $this->model_mahasiswa->getAll();
            $this->load->view('view_mahasiswa',$data);
        }
        

        function register_member(){
            $email=$this->input->post('email');
            $pwd=sha1($this->input->post('password')) ;
            $data_cek = array('email' => $this->input->post('email')
                       
            );
            $hasil = $this->model_user->cek_user($data_cek);
            if ($hasil->num_rows() == 1) {
                
                $data['title']="Register";
                $data['cek']='email';
                $this->load->view('head',$data);
                $this->load->view('view_register');
                $this->load->view('footer');

            }else{
                 date_default_timezone_set('Asia/Jakarta');
                 $kode_aktivasi=time().$email;
                 $aktif_link=md5($kode_aktivasi) ;
                 $generate_id=time();
                 $random=rand(000000,999999);
                 $i_id_user=$generate_id+$random;

                 $dataInsert=array(
                'nama'=>  $this->input->post('nama'),
                'email'=>  $this->input->post('email'),
                'password'=> sha1($this->input->post('password')) ,
                'level'=> 'member',
                'kode_aktivasi'=> $aktif_link,
                'id_user'   =>  $i_id_user
                );
                $this->model_user->register_member($dataInsert);
                $session=$this->model_user->query_for_control("SELECT * from user where email='$email' and password='$pwd'");
               // echo $session['nama'];
                // $_SESSION['nama']=$session['nama'];
                //  $_SESSION['email']=$session['email'];
                //  $_SESSION['level']=$session['level'];
                //  $_SESSION['id_user']=$session['id_user'];
                //  $_SESSION['provinsi']=$session['provinsi'];
                //  $_SESSION['daerah']=$session['daerah'];
                //  $_SESSION['telp']=$session['telp'];
                //  $_SESSION['pin_bb']=$session['pin_bb'];

                $msg='silahkan klik link berikut untuk mengaktifkan akun anda di otomotifstore  '.site_url().'aktivasi/verifikasi/true/'.$session['id_user'].'/'.$aktif_link.'/'.time();

                $config= array(
                    'protocol' => 'smtp', 
                    'smtp_host' =>  'ssl://srv12.niagahoster.com',
                    'smtp_port' =>  465,
                    'smtp_user' =>  'noreply@otomotifstore.com',
                    'smtp_pass' =>  'wildan071017');
                $this->load->library('email' , $config);
                $this->email->set_newline("\r\n");

                $this->email->from('noreply@otomotifstore.com' , 'otomotifstore.com');
                $this->email->to("$email");
                $this->email->subject('Aktivasi akun otomotifstore');
                $this->email->message($msg);
                if ($this->email->send()) {
                     redirect('aktivasi');
                }else{
                    show_error($this->email->print_debugger());
                }
                
            }
        
           
        }


        function perbarui(){
            
            $daerah=$this->input->post('daerah');
            $telp=$this->input->post('telp');
            $pin_bb=$this->input->post('pin_bb');
            $nama=$this->input->post('nama');
            $data_prov = $this->model_user->query_for_control("SELECT * from provinsi where id_provinsi=".$this->input->post('provinsi'));
            $provinsi=$data_prov['nama_provinsi'];
            $this->model_user->query_insert("UPDATE `user` SET `provinsi`='$provinsi',`daerah`='$daerah',`telp`='$telp',`pin_bb`='$pin_bb' ,`nama`='$nama'  WHERE id_user=".$_SESSION['id_user']);
              $session=$this->model_user->query_for_control("SELECT * from user where id_user=".$_SESSION['id_user']);
           // echo $session['nama'];
            $_SESSION['nama']=$session['nama'];
             $_SESSION['email']=$session['email'];
             $_SESSION['level']=$session['level'];
             $_SESSION['id_user']=$session['id_user'];
             $_SESSION['provinsi']=$session['provinsi'];
             $_SESSION['daerah']=$session['daerah'];
             $_SESSION['telp']=$session['telp'];
             $_SESSION['pin_bb']=$session['pin_bb'];
            redirect('profil/setting/1');
         }
        
        function insert(){
            $dataInsert=array(
                'nim'=>  $this->input->post('nim'),
                'nama'=>  $this->input->post('nama'),
                'alamat'=> $this->input->post('alamat')
            );
            $this->model_mahasiswa->insert($dataInsert);
            redirect('mahasiswa');
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
