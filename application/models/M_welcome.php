<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Welcome extends CI_Model
{
    function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
/*           if(empty($this->session->userdata('is_login'))){
			$url=base_url();
			redirect($url);
		}*/

/*		if($this->session->userdata('is_login')){
			$user = $this->session->userdata('jenis_user');
			$url=base_url().$user;
			redirect($url);
		}*/
		
	}
    public function proses_login($username, $password)
    {
        $query = $this->db->get_where('tbl_login',array('username'=>$username));
        if($query->num_rows()>0)
        {
            $data_user = $query->row();
            if(password_verify($password, $data_user->password))
            {
                $this->session->set_userdata('username', $data_user->username);
                $this->session->set_userdata('nipp', $data_user->nipp);
                $this->session->set_userdata('nama', $data_user->nama);
                $this->session->set_userdata('level', $data_user->level);
                $this->session->set_userdata('is_login', TRUE);
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }

}
?>