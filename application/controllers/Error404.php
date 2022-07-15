<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {
    
     public function index()
	{
        if($this->session->userdata('level') == '1'){
            redirect(base_url().'admin');
        }
        elseif($this->session->userdata('level') == '3')
        {
            redirect(base_url().'user');
        }
        else{
            redirect(base_url());
        }
}
}
?>
