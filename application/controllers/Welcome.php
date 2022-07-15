<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
            $this->load->view('welcome_message');
        }
		
		
	}

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

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($this->m_welcome->proses_login($username, $password))
		{
			if($this->session->userdata('level')=='1'){
			redirect('admin');
			}
			if($this->session->userdata('level')=='3'){
				redirect('user');
			}
			else{
				redirect('admin');
			}
		}
		else
		{
			$this->session->set_flashdata('error','Username atau Password salah');
			$url=base_url();
			redirect($url);
		}
	}

	public function logout()
    {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nipp');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('level');
		$this->session->unset_userdata('is_login');
		$this->session->sess_destroy();
		$url = base_url();
		redirect($url);
    }
}
