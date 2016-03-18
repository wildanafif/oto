<?php

class Email extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_global');
        session_start();
        
    }

    function index(){
        $config= array(
            'protocol' => 'smtp', 
            'smtp_host' =>  'ssl://smtp.googlemail.com',
            'smtp_port' =>  465,
            'smtp_user' =>  'wildanafif00@gmail.com',
            'smtp_pass' =>  'butuhkebenaranabadi');
        $this->load->library('email' , $config);
        $this->email->set_newline("\r\n");

        $this->email->from('wildanafif00@gmail.com' , 'wildan');
        $this->email->to('wildanafif666@gmail.com');
        $this->email->subject('this email prorotype');
        $this->email->message('its work');
        if ($this->email->send()) {
           echo "email terkiri";
        }else{
            show_error($this->email->print_debugger());
        }
    }
        

       
}
?>
