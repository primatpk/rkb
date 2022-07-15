<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		
		parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('session');
		if(empty($this->session->userdata('is_login'))){
			$url=base_url();
			redirect($url);
		}
		if($this->session->userdata('level') != '1'){
			$user = $this->session->userdata('level');
			if($user == "3"){
				redirect(base_url().'user');	
			}
			else{
				redirect(base_url());
			}
		}
	}
	
	public function index()
	{
		$this->load->view('admin/v_admin_header');
		$this->load->view('admin/v_admin_sitebar');
		$this->load->view('admin/v_admin');
		$this->load->view('admin/v_admin_footer');
		$this->load->view('admin/v_admin_js');
	}

	public function direktorat()
	{
		$data["direktorat"] = $this->m_admin->get_direktorat();
		$this->load->view('admin/v_admin_header');
		$this->load->view('admin/v_admin_sitebar');
		$this->load->view('admin/v_direktorat', $data);
		$this->load->view('admin/v_admin_footer');
		$this->load->view('admin/v_admin_js');
	}

	public function input_direktorat()
	{
		$this->form_validation->set_rules('kd_direktorat', 'Kode Direktorat', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$kd_direktorat = $this->input->post('kd_direktorat');
			$deskripsi = $this->input->post('deskripsi');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'kd_direktorat' => $kd_direktorat,
				'deskripsi_direktorat' => $deskripsi,
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);

			$this->m_admin->input_direktorat($data, 'tbl_direktorat');
			$this->session->set_flashdata('tambah_direktorat', 'Berhasil tambah data Direktorat');
			redirect('admin/direktorat');
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/direktorat');
		}
	}

	public function edit_direktorat()
	{
		//$this->form_validation->set_rules('kd_direktorat', 'Kode Direktorat', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$kd_direktorat = $this->input->post('kd_direktorat');
			$deskripsi = $this->input->post('deskripsi');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'deskripsi_direktorat' => $deskripsi,
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);

			$where = array('kd_direktorat' => $kd_direktorat);

			$this->m_admin->edit_direktorat($where, $data, 'tbl_direktorat');
			$this->session->set_flashdata('edit_direktorat', 'Berhasil edit data Direktorat');
			redirect('admin/direktorat');
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/direktorat');
		}
	}

	public function hapus_direktorat($kd_direktorat)
	{
		$where = array('kd_direktorat' => $kd_direktorat);
		$this->m_admin->hapus_direktorat($where, 'tbl_direktorat');
		$this->session->set_flashdata('hapus_direktorat', 'Berhasil hapus data Direktorat');
		redirect('admin/direktorat');
	}

	public function divisi()
	{
		$data["direktorat"] = $this->m_admin->get_direktorat();
		$data["divisi"] = $this->m_admin->get_divisi();
		$this->load->view('admin/v_admin_header');
		$this->load->view('admin/v_admin_sitebar');
		$this->load->view('admin/v_divisi', $data);
		$this->load->view('admin/v_admin_footer');
		$this->load->view('admin/v_admin_js');
	}

	public function input_divisi()
	{
		$this->form_validation->set_rules('kd_direktorat', 'Kode Direktorat', 'trim|required');
		$this->form_validation->set_rules('kd_divisi', 'Kode Divisi', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$kd_direktorat = $this->input->post('kd_direktorat');
			$kd_divisi = $this->input->post('kd_divisi');
			$deskripsi = $this->input->post('deskripsi');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'kd_direktorat' => $kd_direktorat,
				'kd_divisi' => $kd_divisi,
				'deskripsi_divisi' => $deskripsi,
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);

			$this->m_admin->input_divisi($data, 'tbl_divisi');
			$this->session->set_flashdata('tambah_divisi', 'Berhasil tambah data Divisi');
			redirect('admin/divisi');
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/divisi');
		}
	}

	public function edit_divisi()
	{
		$this->form_validation->set_rules('kd_direktorat', 'Kode Direktorat', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$kd_divisi = $this->input->post('kd_divisi');
			$kd_direktorat = $this->input->post('kd_direktorat');
			$deskripsi = $this->input->post('deskripsi');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'kd_direktorat' => $kd_direktorat,
				'deskripsi_divisi' => $deskripsi,
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);

			$where = array('kd_divisi' => $kd_divisi);

			$this->m_admin->edit_divisi($where, $data, 'tbl_divisi');
			$this->session->set_flashdata('edit_divisi', 'Berhasil edit data Divisi');
			redirect('admin/divisi');
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/divisi');
		}
	}

	public function hapus_divisi($kd_divisi)
	{
		$where = array('kd_divisi' => $kd_divisi);
		$this->m_admin->hapus_divisi($where, 'tbl_divisi');
		$this->session->set_flashdata('hapus_divisi', 'Berhasil hapus data Divisi');
		redirect('admin/divisi');
	}

	public function jabatan()
	{
		$data["direktorat"] = $this->m_admin->get_direktorat();
		$data["divisi"] = $this->m_admin->get_divisi();
		$data["jabatan"] = $this->m_admin->get_jabatan();
		
		//$this->load->view('admin/v_admin_sitebar');
		$this->load->view('admin/v_jabatan', $data);
	
	}

	public function list_jabatan()
        {
            $list = $this->m_admin->get_datatablesJabatan();
            $data = array();
            $no = $_POST['start'];
            foreach($list as $jabatan){
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $jabatan->kd_jabatan;
                $row[] = $jabatan->kd_direktorat;
                $row[] = $jabatan->kd_divisi;
                $row[] = $jabatan->deskripsi;
                $row[] = $jabatan->waktu_update;
                $row[] = $jabatan->updated_by;
                $row[] = '<a class="btn" data-toggle="modal" data-target="#editJabatanModal'.$jabatan->kd_jabatan .'">
				<i class="fa fa-edit"></i></a>';
				$row[] = '<a class="btn" href="hapus_jabatan/'.$jabatan->kd_jabatan.'"><i class="fa fa-trash"></i></a>';

                $data[] = $row;
            }

            $output = array(
                        "draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin->count_all(),
						"recordsFiltered" => $this->m_admin->count_filtered(),
						"data" => $data,
            );
            echo json_encode($output);
        }

	public function input_jabatan()
	{
		$this->form_validation->set_rules('kd_jabatan', 'Kode Jabatan', 'trim|required');
		$this->form_validation->set_rules('kd_direktorat', 'Kode Direktorat', 'trim|required');
		$this->form_validation->set_rules('kd_divisi', 'Kode Divisi', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$kd_jabatan = $this->input->post('kd_jabatan');
			$kd_divisi = $this->input->post('kd_divisi');
			$kd_direktorat = $this->input->post('kd_direktorat');
			$deskripsi = $this->input->post('deskripsi');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'kd_jabatan' => $kd_jabatan,
				'kd_direktorat' => $kd_direktorat,
				'kd_divisi' => $kd_divisi,
				'deskripsi' => $deskripsi,
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);
			
			$this->m_admin->input_jabatan($data, 'tbl_jabatan');
			$this->session->set_flashdata('tambah_jabatan', 'Berhasil tambah Jabatan');
			redirect('admin/jabatan');
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/jabatan');
		}
	}

	public function hapus_jabatan($kd_jabatan)
	{
		$where = array('kd_jabatan' => $kd_jabatan);
		$this->m_admin->hapus_jabatan($where, 'tbl_jabatan');
		$this->session->set_flashdata('hapus_jabatan', 'Berhasil hapus Jabatan');
		redirect('admin/jabatan');
	}

	public function edit_jabatan()
	{
		
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$kd_jabatan = $this->input->post('kd_jabatan');
			$deskripsi = $this->input->post('deskripsi');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'deskripsi' => $deskripsi,
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);

			$where = array('kd_jabatan' => $kd_jabatan);
			
			$this->m_admin->edit_jabatan($where, $data, 'tbl_jabatan');
			$this->session->set_flashdata('edit_jabatan', 'Berhasil edit Jabatan');
			redirect('admin/jabatan');
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/jabatan');
		}
	}

	public function pegawai()
	{
		$data["direktorat"] = $this->m_admin->get_direktorat();
		$data["divisi"] = $this->m_admin->get_divisi();
		$data["jabatan"] = $this->m_admin->get_jabatan();
		$data["pegawai"] = $this->m_admin->get_pegawai();


		//$this->load->view('admin/v_admin_sitebar');
		$this->load->view('admin/v_pegawai', $data);

	}

	public function cari_pegawai()
	{
		$nipp = $_GET['nipp'];
		$cari = $this->m_admin->cari_pegawai($nipp);
		echo json_encode($cari);
	}

	public function input_pegawai()
	{
		$this->form_validation->set_rules('nipp', 'NIPP', 'trim|required');
	/*	$this->form_validation->set_rules('kd_direktorat', 'Kode Direktorat', 'trim|required');
		$this->form_validation->set_rules('kd_divisi', 'Kode Divisi', 'trim|required');
		$this->form_validation->set_rules('kd_jabatan', 'Kode Jabatan', 'trim|required');
		$this->form_validation->set_rules('kd_atasan', 'Kode Jabatan', 'trim|required');
*/		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$nipp = $this->input->post('nipp');
			$kd_direktorat = $this->input->post('kd_direktorat');
			$kd_divisi = $this->input->post('kd_divisi');
			$kd_jabatan = $this->input->post('kd_jabatan');
			$kd_atasan = $this->input->post('kd_atasan');
			$nama = $this->input->post('nama');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'nipp' => $nipp,
				'kd_direktorat' => $kd_direktorat,
				'kd_divisi' => $kd_divisi,
				'kd_atasan' => $kd_atasan,
				'kd_jabatan' => $kd_jabatan,
				'nama' => $nama,
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);
			if($this->m_admin->cek_pegawai($nipp))
			{
				$this->session->set_flashdata('error_input', 'Data yang Anda masukkan sudah ada!');
            	redirect('admin/pegawai');
			}
			else{
				$this->m_admin->input_pegawai($data, 'tbl_pegawai');
				redirect('admin/pegawai');
				
			}
			
			
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/pegawai');
		}
	}

	public function list_pegawai()
        {
            $list = $this->m_admin->get_datatablesPegawai();
            $data = array();
            $no = $_POST['start'];
            foreach($list as $pegawai){
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $pegawai->nipp;
                $row[] = $pegawai->kd_direktorat;
				$row[] = $pegawai->kd_divisi;
				$row[] = $pegawai->kd_atasan;
				$row[] = $pegawai->kd_jabatan;
                $row[] = $pegawai->nama;
                $row[] = $pegawai->waktu_update;
                $row[] = $pegawai->updated_by;
                $row[] = '<a class="btn" data-toggle="modal" data-target="#editPegawaiModal'.$pegawai->nipp .'">
				<i class="fa fa-edit"></i></a>';
				$row[] = '<a class="btn" href="hapus_pegawai/'.$pegawai->nipp.'"><i class="fa fa-trash"></i></a>';

                $data[] = $row;
            }

            $output = array(
                        "draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin->count_all2(),
						"recordsFiltered" => $this->m_admin->count_filtered2(),
						"data" => $data,
            );
            echo json_encode($output);
		}
		
	public function hapus_pegawai($nipp)
	{
		$where = array('nipp' => $nipp);
		$this->m_admin->hapus_pegawai($where, 'tbl_pegawai');
		$this->session->set_flashdata('sukses_delete', 'Berhasil hapus data pegawai');
		redirect('admin/pegawai');
	}

	public function data_login()
	{
		$data["pegawai"] = $this->m_admin->get_pegawai();
		$data["akses"] = $this->m_admin->get_akses();
		$data["login"] = $this->m_admin->getLogin();

		//$this->load->view('admin/v_admin_sitebar');
		$this->load->view('admin/v_login', $data);

	}

	public function list_pengguna()
        {
            $list = $this->m_admin->get_datatablesPengguna();
            $data = array();
            $no = $_POST['start'];
            foreach($list as $user){
                $no++;
                $row = array();
                $row[] = $no;
				$row[] = $user->username;
				$row[] = $user->nama;
                $row[] = $user->nipp;
				$row[] = $user->level;
                $row[] = $user->waktu_update;
                $row[] = $user->updated_by;
                $row[] = '<a class="btn" href="edit_user/'.$user->username.'">
				<i class="fa fa-edit"></i></a>';
				$row[] = '<a class="btn" href="hapus_login/'.$user->username.'"><i class="fa fa-trash"></i></a>';

                $data[] = $row;
            }

            $output = array(
                        "draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin->count_all3(),
						"recordsFiltered" => $this->m_admin->count_filtered3(),
						"data" => $data,
            );
            echo json_encode($output);
		}
	
	public function input_user()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('nipp', 'NIPP', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$username = $this->input->post('username');
			$nipp = $this->input->post('nipp');
			$nama = $this->input->post('nama');
			$level = $this->input->post('level');
			$password = $this->input->post('password');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'username' => $username,
				'nipp' => $nipp,
				'nama' => $nama,
				'level' => $level,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);
			if($this->m_admin->cek_login($username)){
				$this->session->set_flashdata('error_input', 'Data yang Anda masukkan sudah ada!');
            	redirect('admin/data_login');
			}
			else{
				$this->m_admin->input_user($data, 'tbl_login');
				$this->session->set_flashdata('sukses_input', 'Berhasil input data');
				redirect('admin/data_login');
			}
			
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/data_login');
		}
	}

	public function hapus_login($username)
	{
		$where = array('username' => $username);
		$this->m_admin->hapus_login($where, 'tbl_login');
		redirect('admin/data_login');
	}

	public function monitoring_rkb()
	{
		//$this->load->view('admin/v_admin_sitebar');
		$this->load->view('admin/v_monitoring_rkb');
	}

	public function edit_pegawai()
	{
		//$this->form_validation->set_rules('nipp', 'NIPP', 'trim|required');
		$this->form_validation->set_rules('kd_direktorat', 'Kode Direktorat', 'trim|required');
		$this->form_validation->set_rules('kd_divisi', 'Kode Divisi', 'trim|required');
		$this->form_validation->set_rules('kd_jabatan', 'Kode Jabatan', 'trim|required');
		$this->form_validation->set_rules('kd_atasan', 'Kode Jabatan', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$kd_direktorat = $this->input->post('kd_direktorat');
			$kd_divisi = $this->input->post('kd_divisi');
			$kd_jabatan = $this->input->post('kd_jabatan');
			$kd_atasan = $this->input->post('kd_atasan');
			$nama = $this->input->post('nama');
			$waktu_update = $this->input->post('waktu_update');
			$updated_by = $this->session->userdata('username');

			$data = array(
				'kd_direktorat' => $kd_direktorat,
				'kd_divisi' => $kd_divisi,
				'kd_atasan' => $kd_atasan,
				'kd_jabatan' => $kd_jabatan,
				'nama' => $nama,
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);
			$nipp = $this->input->post('nipp');
			$where = array('nipp'=>$nipp);
			$this->m_admin->edit_pegawai($where, $data, 'tbl_pegawai');
			$this->session->set_flashdata('edit', 'Edit Data Pegawai Berhasil');
			redirect('admin/pegawai');
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/pegawai');
		}
	}

	public function edit_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		//$this->form_validation->set_rules('nipp', 'NIPP', 'trim|required');
		//$this->form_validation->set_rules('level', 'Level Akses', 'trim|required');

		if($this->form_validation->run()==true)
		{
			//$level = $this->input->post('level');
			$waktu_update = $this->input->post('waktu_update');
			$password = $this->input->post('password');
			$updated_by = $this->session->userdata('username');

			$data = array(	
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'waktu_update' => $waktu_update,
				'updated_by' => $updated_by
			);
			$username = $this->input->post('username');
			$where = array('username'=>$username);
			$this->m_admin->edit_user($where, $data, 'tbl_login');
			$this->session->set_flashdata('sukses_edit', 'Reset Password Pengguna Berhasil');
			redirect('admin/data_login');
		}
	}

	public function list_rkb()
        {
            $list = $this->m_admin->get_datatablesrkb();
            $data = array();
            $no = $_POST['start'];
            foreach($list as $rkb){
                $no++;
                $row = array();
				$row[] = $no;
				if($rkb->bulan==1){
					$row[] = "Jan ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==2){
					$row[] = "Feb ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==3){
					$row[] = "Mar ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==4){
					$row[] = "Apr ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==5){
					$row[] = "Mei ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==6){
					$row[] = "Jun ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==7){
					$row[] = "Jul ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==8){
					$row[] = "Agst ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==9){
					$row[] = "Sept ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==10){
					$row[] = "Okt ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==11){
					$row[] = "Nov ".$rkb->tahun;
				  }
				  elseif($rkb->bulan==12){
					$row[] = "Des ".$rkb->tahun;
				  }
				  else{
					$row[] = "";
				  }
				
				
				//$row[] = $rkb->bulan;
                $row[] = $rkb->nama;
                $row[] = $rkb->deskripsi_divisi;
           /*     if($rkb->status_rkb=="0" OR $rkb->status_rkb=="1"){
					$row[] = "<h style='color:green'>Sudah dikirim<h>";
				}
				else{
					$row[] = "<h style='color:red'>Belum dikirim</h>";
				} */
                if($rkb->status_rkb=="0"){
					$row[] = "<h style='color:red'>Belum Disetujui</h>";
				}
				elseif($rkb->status_rkb=="1"){
					$row[] = "<h style='color:green'>Sudah Disetujui</h>";
				}
				elseif($rkb->status_rkb=="2"){
					$row[] = "<h style='color:red'>Direvisi</h>";
				}
				else{
					$row[] = "Tidak Ada Data";
				}
				$row[] =$rkb->waktu_rkb;
				$row[] =$rkb->waktu_approve_rkb;
				if($rkb->status_realisasi=="0" OR $rkb->status_realisasi=="1"){
					$row[] = "<h style='color:green'>Sudah dikirim<h>";
				}
				else{
					$row[] = "<h style='color:red'>Belum dikirim</h>";
				}
				$row[] =$rkb->waktu_approve_realisasi;
                if($rkb->status_realisasi=="0"){
					$row[] = "<h style='color:red'>Belum Disetujui</h>";
				}
				elseif($rkb->status_realisasi=="1"){
					$row[] = "<h style='color:green'>Sudah Disetujui</h>";
				}
				elseif($rkb->status_realisasi=="2"){
					$row[] = "<h style='color:red'>Direvisi</h>";
				}
				else{
					$row[] = "Tidak Ada Data";
				}
				
				//$row[] = $rkb->nilai_rkb;
				if($rkb->nilai_rkb > 360){
					$row[] = $rkb->nilai_rkb." / (A)";
				  }
				elseif($rkb->nilai_rkb >330 AND $rkb->nilai_rkb <=360){
					$row[] = $rkb->nilai_rkb." / (B)";
				  }
				elseif($rkb->nilai_rkb >280 AND $rkb->nilai_rkb <=330){
					$row[] = $rkb->nilai_rkb." / (C)";
				  }
				elseif($rkb->nilai_rkb >250 AND $rkb->nilai_rkb <=280){
					$row[] = $rkb->nilai_rkb." / (D)";
				  }
				else{
					$row[] = $rkb->nilai_rkb." / (E)";
				}
				$row[] = $rkb->waktu_approve_realisasi;

                $data[] = $row;
            }

            $output = array(
                        "draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin->count_all4(),
						"recordsFiltered" => $this->m_admin->count_filtered4(),
						"data" => $data,
            );
            echo json_encode($output);
        }
	
		public function monitoring_realisasi()
		{
			$this->load->view('admin/v_admin_sitebar');
			$this->load->view('admin/v_monitoring_realisasi');
		}

		public function list_realisasi()
        {
            $list = $this->m_admin->get_datatablesrkb();
            $data = array();
            $no = $_POST['start'];
            foreach($list as $rkb){
                $no++;
                $row = array();
				$row[] = $no;
				$row[] = $rkb->tahun;
				$row[] = $rkb->bulan;
                $row[] = $rkb->nama;
                $row[] = $rkb->deskripsi_divisi;
                $row[] = $rkb->deskripsi;
                if($rkb->status_realisasi=="0" OR $rkb->status_realisasi=="1"){
					$row[] = "<h style='color:green'>Sudah dikirim<h>";
				}
				else{
					$row[] = "<h style='color:red'>Belum dikirim</h>";
				}
                if($rkb->status_realisasi=="0"){
					$row[] = "<h style='color:red'>Belum Disetujui</h>";
				}
				elseif($rkb->status_realisasi=="1"){
					$row[] = "<h style='color:green'>Sudah Disetujui</h>";
				}
				elseif($rkb->status_realisasi=="2"){
					$row[] = "<h style='color:red'>Direvisi</h>";
				}
				else{
					$row[] = "Tidak Ada Data";
				}

                $data[] = $row;
            }

            $output = array(
                        "draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin->count_all4(),
						"recordsFiltered" => $this->m_admin->count_filtered4(),
						"data" => $data,
            );
            echo json_encode($output);
        }

		public function edit_user($username)
		{

			$data["login"] = $this->m_admin->getLogin2($username);

			$this->load->view('admin/v_admin_header');
			$this->load->view('admin/v_admin_sitebar');
			$this->load->view('admin/v_edit_login', $data);
			$this->load->view('admin/v_admin_footer');
			$this->load->view('admin/v_admin_js');
		}
}