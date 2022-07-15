<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		
		parent::__construct();
            $this->load->library('form_validation');
			$this->load->library('session');
			
		if(empty($this->session->userdata('is_login'))){
			$url=base_url();
			redirect($url);
		}
		if($this->session->userdata('level') != '3'){
			$user = $this->session->userdata('level');
			if($user == "1"){
				redirect(base_url().'admin');	
			}
			else{
				redirect(base_url());
			}
			
		}
	}
	
	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('halaman_depan');
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function input_rkb()
	{
		$nipp = $this->session->userdata('nipp');
		$data["rkb"] = $this->m_user->get_rkb($nipp);
		$data["pegawai"] = $this->m_user->get_pegawai($nipp);
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('input_rkb', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function input_kegiatan()
	{
		$this->form_validation->set_rules('uraian', 'Rencana Kegiatan', 'trim|required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');
		$this->form_validation->set_rules('target', 'Target', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$waktu_rkb = $this->input->post('waktu_rkb');
			$uraian = $this->input->post('uraian');
			$bobot = $this->input->post('bobot');
			$target = $this->input->post('target');
			$satuan = $this->input->post('satuan');
			$nipp = $this->input->post('nipp');
			$id_approval = $this->input->post('id_approval');
			$status_rkb = "0";
			$status_kirim_rkb = "0";

			$data = array(
				'id_approval' => $id_approval,
				'nipp' => $nipp,
				'bulan' => $bulan,
				'tahun' => $tahun,
				'uraian' => $uraian,
				'bobot' => $bobot,
				'target' => $target,
				'satuan' => $satuan,
				'waktu_rkb' => $waktu_rkb,
				'status_rkb' => $status_rkb,
				'status_kirim_rkb' => $status_kirim_rkb
			);

			if($this->m_user->cek_input_rkb($id_approval)){
				$this->session->set_flashdata('error_input_rkb', 'Anda sudah mengirimkan RKB Bulan ini');
                redirect('user/input_rkb');
			}
			else{
				$this->m_user->input_kegiatan($data, 'tbl_rkb');
				$this->session->set_flashdata('success_tambah_rkb', 'Tambah Kegiatan Berhasil');
				redirect('user/input_rkb');
			}
			
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('user/input_rkb');
		}
	}

	public function edit_input_rkb()
	{
		$this->form_validation->set_rules('uraian', 'Rencana Kegiatan', 'trim|required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');
		$this->form_validation->set_rules('target', 'Target', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$id_rkb = $this->input->post('id_rkb');
			$uraian = $this->input->post('uraian');
			$bobot = $this->input->post('bobot');
			$target = $this->input->post('target');
			$satuan = $this->input->post('satuan');
			$waktu_rkb = $this->input->post('waktu_rkb');

			$data = array(
				'uraian' => $uraian,
				'bobot' => $bobot,
				'target' => $target,
				'satuan' => $satuan,
				'waktu_rkb' => $waktu_rkb,
			);

			$where = array('id_rkb'=>$id_rkb);

			$this->m_user->edit_input_rkb($where, $data, 'tbl_rkb');
			$this->session->set_flashdata('success_edit_rkb', 'Edit Kegiatan Berhasil');
			redirect('user/input_rkb');
			
			
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('user/input_rkb');
		}
	}

	public function hapus_rkb($id_rkb="")
	{
		$where = array('id_rkb' => $id_rkb);
		$this->m_user->hapus_rkb($where, 'tbl_rkb');
		redirect('user/input_rkb');
	}

	public function kirim_rkb()
	{
		$id_approval = $this->input->post('id_approval');
		$nipp = $this->input->post('nipp');
		$nama = $this->input->post('nama');
		$kd_jabatan = $this->input->post('kd_jabatan');
		$kd_atasan = $this->input->post('kd_atasan');
		$waktu_rkb = $this->input->post('waktu_rkb');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$total_bobot = $this->input->post('total_bobot');
		$status_rkb = "0";
		$status_kirim_rkb = "1";

		$data = array(
			'id_approval' => $id_approval,
			'nipp' => $nipp,
			'nama' => $nama,
			'kd_jabatan' => $kd_jabatan,
			'kd_atasan' => $kd_atasan,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'waktu_rkb' => $waktu_rkb,
			'total_bobot' => $total_bobot,
			'status_rkb' => $status_rkb
		);

		$data2 = array(
			'status_kirim_rkb' => $status_kirim_rkb,
		);

		$where = array('id_approval' => $id_approval);

		$this->m_user->update_kegiatan($where, $data2, 'tbl_rkb');
		$this->m_user->kirim_rkb($data, 'tbl_approval_rkb');
		$this->session->set_flashdata('success_kirim_rkb', 'Kirim RKB Berhasil. RKB Menunggu Approval Atasan');
		redirect('user/input_rkb');
	}

	public function approval()
	{
		$nipp = $this->session->userdata('nipp');
		$query = $this->db->get_where('tbl_pegawai',array('nipp'=>$nipp));
		$data_user = $query->row();
		$kd_jabatan = $data_user->kd_jabatan;
		
		$status_rkb = "0";
		$data["approval"] = $this->m_user->get_approval($kd_jabatan, $status_rkb);
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('approval', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function detail_rkb($id_approval="")
	{
		$status_kirim_rkb = "1";
		$status_rkb = "0";
		$where = array('id_approval'=>$id_approval, 'status_kirim_rkb'=>$status_kirim_rkb, 'status_rkb'=>$status_rkb);
		$data["detail"] = $this->m_user->detail_rkb($where, 'tbl_rkb')->result();
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('detail_rkb', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function approve_rkb()
	{
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if($this->form_validation->run()==true)
		{
			$id_approval = $this->input->post('id_approval');
			$waktu_approve_rkb = $this->input->post('waktu_approve_rkb');
			$keterangan = $this->input->post('keterangan');
			$status_rkb = "1";
			$status_rkb2 = "2";
			$status_kirim_rkb = "0";

			if(isset($_POST['setuju'])){
				$data = array(
					'status_rkb' => $status_rkb,
					'waktu_approve_rkb' => $waktu_approve_rkb,
					'keterangan' => $keterangan
				);
				$data2 = array(
					'status_rkb' => $status_rkb,
					'waktu_approve_rkb' => $waktu_approve_rkb,
				);
				$where = array('id_approval' => $id_approval);
				$this->m_user->update_kegiatan($where, $data2, 'tbl_rkb');
				$this->m_user->update_approval($where, $data, 'tbl_approval_rkb');
				$this->session->set_flashdata('setuju_rkb', 'RKB sudah disetujui');
				redirect('user/approval');
			}
			elseif(isset($_POST['tolak'])){
				$data = array(
					'status_rkb' => $status_rkb2,
					'waktu_approve_rkb' => $waktu_approve_rkb,
					'keterangan' => $keterangan
				);
				$data2 = array(
					'status_rkb' => $status_rkb2,
					'waktu_approve_rkb' => $waktu_approve_rkb,
				);
				$where = array('id_approval' => $id_approval);
				$this->m_user->update_kegiatan($where, $data2, 'tbl_rkb');
				$this->m_user->update_approval($where, $data, 'tbl_approval_rkb');
				$this->session->set_flashdata('tolak_rkb', 'RKB sudah dikembalikan');
				redirect('user/approval');
		}
		}
		else{
				$id_approval = $this->input->post('id_approval');
				$this->session->set_flashdata('error', 'Kolom Ketarangan Wajib diisi');
				redirect('user/detail_rkb/'.$id_approval);
		}
		
	}

	public function riwayat_rkb()
	{
		$nipp = $this->session->userdata('nipp');
		
		$data["riwayat"] = $this->m_user->get_riwayat_rkb($nipp);
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('riwayat_rkb', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function detail($id_approval="")
	{
		$where = array('id_approval'=>$id_approval);
		$data["detail"] = $this->m_user->detail_rkb($where, 'tbl_rkb')->result();
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('detail', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function print_rkb($id_approval="")
	{
		//$id_approval = $this->input->post('id_approval');
		$nipp = $this->session->userdata('nipp');

		$query = $this->db->get_where('tbl_pegawai',array('nipp'=>$nipp));
		$data_user = $query->row();
		$kd_jabatan = $data_user->kd_jabatan;
		$kd_atasan = $data_user->kd_atasan;

		$where = array('id_approval'=>$id_approval);
		$data["pegawai"] = $this->m_user->get_pegawai($nipp);
		$data["nama_atasan"] = $this->m_user->get_nama_atasan($kd_atasan);
		$data["detail"] = $this->m_user->detail_rkb($where, 'tbl_rkb')->result();
		$data["jabatan"] = $this->m_user->get_jabatan($kd_jabatan);
		$data["atasan"] = $this->m_user->get_atasan($kd_atasan);
		$data["bulan"] = $this->m_user->get_bulan($id_approval);
		$this->load->view('print_rkb', $data);
	}

	public function edit_rkb($id_approval="")
	{
		$nipp = $this->session->userdata('nipp');
		$data["edit"] = $this->m_user->edit_rkb($id_approval);
		$data["keterangan"] = $this->m_user->cek_keterangan($id_approval);
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('edit_rkb', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function edit_kegiatan()
	{
		$this->form_validation->set_rules('uraian', 'Uraian', 'trim|required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$id_approval = $this->input->post('id_approval');
			$id_rkb = $this->input->post('id_rkb');
			$uraian = $this->input->post('uraian');
			$bobot = $this->input->post('bobot');
			$target = $this->input->post('target');
			$satuan = $this->input->post('satuan');
			$waktu_rkb = $this->input->post('waktu_rkb');

			$data = array(
				'uraian' => $uraian,
				'bobot' => $bobot,
				'target' => $target,
				'satuan' => $satuan,
				'waktu_rkb' => $waktu_rkb
			);
			$where = array('id_rkb' => $id_rkb);

			$this->m_user->edit_kegiatan($where, $data, 'tbl_rkb');
			$this->session->set_flashdata('edit_rkb', 'Edit RKB Berhasil');
			//$url = $this->edit_rkb($id_approval);
			redirect('user/edit_rkb/'.$id_approval);
		}
		else{
			$id_approval = $this->input->post('id_approval');
			$this->session->set_flashdata('error', validation_errors());
            redirect('user/edit_rkb/'.$id_approval);
		}
	}

	public function hapus_rkb2($id_rkb="")
	{
		$where = array('id_rkb' => $id_rkb);
		$this->m_user->hapus_rkb($where, 'tbl_rkb');
		$id_approval = $this->session->userdata('nipp').date('Y').date('m');
		redirect('user/edit_rkb/'.$id_approval);
	}

	public function tambah_kegiatan()
	{
		$this->form_validation->set_rules('uraian', 'Uraian', 'trim|required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');
		$this->form_validation->set_rules('target', 'Target', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$waktu_rkb = $this->input->post('waktu_rkb');
			$uraian = $this->input->post('uraian');
			$bobot = $this->input->post('bobot');
			$target = $this->input->post('target');
			$satuan = $this->input->post('satuan');
			$nipp = $this->input->post('nipp');
			$id_approval = $this->input->post('id_approval');
			$status_rkb = "2";
			$status_kirim_rkb = "1";

			$data = array(
				'id_approval' => $id_approval,
				'nipp' => $nipp,
				'bulan' => $bulan,
				'tahun' => $tahun,
				'uraian' => $uraian,
				'bobot' => $bobot,
				'target' => $target,
				'satuan' => $satuan,
				'waktu_rkb' => $waktu_rkb,
				'status_rkb' => $status_rkb,
				'status_kirim_rkb' => $status_kirim_rkb
			);

			$this->m_user->input_kegiatan($data, 'tbl_rkb');
			$this->session->set_flashdata('sukses_tambah_rkb', 'Tambah Kegiatan Berhasil');
			redirect('user/edit_rkb/'.$id_approval);
		}
	}

	public function kirim_rkb2()
	{
		$id_approval = $this->input->post('id_approval');
		$waktu_rkb = $this->input->post('waktu_rkb');
		$status_rkb = "0";
		$status_kirim_rkb = "1";
		$keterangan = "";

		$data = array(
			'waktu_rkb' => $waktu_rkb,
			'status_rkb' => $status_rkb,
			'keterangan' => $keterangan
		);

		$data2 = array(
			'status_rkb' => $status_rkb,
			'status_kirim_rkb' => $status_kirim_rkb,
		);

		$where = array('id_approval' => $id_approval);

		$this->m_user->update_kegiatan($where, $data2, 'tbl_rkb');
		$this->m_user->update_kirim_rkb($where, $data, 'tbl_approval_rkb');
		$this->session->set_flashdata('success_kirim_rkb', 'Kirim RKB Berhasil. RKB Menunggu Approval Atasan');
		redirect('user/riwayat_rkb');
	}

	public function realisasi()
	{
		$nipp = $this->session->userdata('nipp');
		$data["real"] = $this->m_user->get_realisasi2($nipp)->result();
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('realisasi', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function input_realisasi($id_approval="")
	{
		//$nipp = $this->session->userdata('nipp');
		$data["rkb"] = $this->m_user->get_realisasi($id_approval)->result();
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('input_realisasi', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function update_realisasi()
	{
		$this->form_validation->set_rules('realisasi', 'Realisasi', 'trim|required');
		//$this->form_validation->set_rules('bukti_realisasi', 'Bukti Realisasi', 'trim|required');
		
		if($this->form_validation->run()==true)
		{
			$id_approval = $this->input->post('id_approval');
			$realisasi = $this->input->post('realisasi');
			$id_rkb = $this->input->post('id_rkb');
			$target = $this->input->post('target');
			$bobot = $this->input->post('bobot');
			$skor = ($realisasi/$target)*100;
			if($skor >0 AND $skor<75){
				$nilai = 1;
			}
			elseif($skor >= 75 AND $skor <90)
			{
				$nilai = 2;
			}
			elseif($skor >= 90 AND $skor <=110){
				$nilai = 3;
			}
			elseif($skor > 110)
			{
				$nilai = 4;
			}
			else{
				$nilai = 0;
			}
			
			$nilai_rkb = $bobot * $nilai;
			$waktu_realisasi = $this->input->post('waktu_realisasi');
			$bukti_realisasi = time().$_FILES["bukti_realisasi"]['name'];
			if($bukti_realisasi=''){}else{
				$config['upload_path'] = './assets/bukti_realisasi';
				$config['allowed_types'] = 'jpg|png|pdf|doc|docx|xls|xlsx|ppt|pptx|rar';
				$config['max_size'] = 2000;
				$config['encrypt_name'] = TRUE;
				$config['file_name'] = $bukti_realiasi;

				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('bukti_realisasi')){
					$this->session->set_flashdata('error_upload', 'File tidak dapat diupload. Upload file dengan ekstensi RAR, DOC, XLS, PPT, PDF, JPG, atau PNG dan ukuran maksimum 2MB');
					redirect('user/input_realisasi/'.$id_approval);
				}
				else{
					$bukti_realisasi = $this->upload->data('file_name');
				}
			}

			$data = array(
				'realisasi' => $realisasi,
				'skor' => $skor,
				'nilai' => $nilai,
				'nilai_rkb' => $nilai_rkb,
				'waktu_realisasi' => $waktu_realisasi,
				'bukti_realisasi' => $bukti_realisasi						
			);
			$where = array('id_rkb' => $id_rkb);

			$this->m_user->input_realisasi($where, $data, 'tbl_rkb');
			$this->session->set_flashdata('sukses_input_realisasi', 'Realisasi berhasil diinput');
			redirect('user/input_realisasi/'.$id_approval);
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('user/input_realisasi/'.$id_approval);
		}
	}

	public function kirim_realisasi()
	{
		$id_approval = $this->input->post('id_approval');
		$nilai_rkb = $this->input->post('nilai_rkb');
		$status_kirim_realisasi = "1";
		$status_realisasi = "0";

		$data = array(
			'nilai_rkb' => $nilai_rkb,
			'status_realisasi' => $status_realisasi
		);

		$data2 = array(
			'status_kirim_realisasi' => $status_kirim_realisasi,
			'status_realisasi' => $status_realisasi
		);

		$where = array('id_approval' => $id_approval);

		$this->m_user->kirim_realisasi_rkb($where, $data2, 'tbl_rkb');
		$this->m_user->kirim_realisasi_atasan($where, $data, 'tbl_approval_rkb');
		$this->session->set_flashdata('sukses_kirim_realisasi', 'Kirim Realisasi Berhasil. Realisasi Menunggu Approval Atasan');
		redirect('user/input_realisasi');
	}

	public function approval_realisasi()
	{
		$nipp = $this->session->userdata('nipp');
		$query = $this->db->get_where('tbl_pegawai',array('nipp'=>$nipp));
		$data_user = $query->row();
		$kd_jabatan = $data_user->kd_jabatan;
		
		$status_realisasi = "0";
		$data["approval"] = $this->m_user->get_approval_realisasi($kd_jabatan, $status_realisasi);
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('approval_realisasi', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function detail_realisasi($id_approval="")
	{
		//$where = array('id_approval'=>$id_approval);
		$status_realisasi = "0";
		$data["detail"] = $this->m_user->detail_realisasi($id_approval, $status_realisasi)->result();
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('detail_realisasi', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function approve_realisasi()
	{
		$this->form_validation->set_rules('keterangan_realisasi', 'Keterangan', 'required');

		if($this->form_validation->run()==true){
			$id_approval = $this->input->post('id_approval');
			$waktu_approve_realisasi = $this->input->post('waktu_approve_realisasi');
			$keterangan_realisasi = $this->input->post('keterangan_realisasi');
			$status_realisasi = "1";
			$status_realisasi2 = "2";

			if(isset($_POST['setuju'])){
				$data = array(
					'status_realisasi' => $status_realisasi,
					'waktu_approve_realisasi' => $waktu_approve_realisasi,
					'keterangan_realisasi' => $keterangan_realisasi
				);
				$data2 = array(
					'status_realisasi' => $status_realisasi,
					'waktu_approve_realisasi' => $waktu_approve_realisasi,
				);
				$where = array('id_approval' => $id_approval);
				$this->m_user->update_realisasi($where, $data2, 'tbl_rkb');
				$this->m_user->update_approval_realisasi($where, $data, 'tbl_approval_rkb');
				$this->session->set_flashdata('sukses_approve_realisasi', 'Realisasi sudah disetujui');
				redirect('user/approval_realisasi');
			}
			elseif(isset($_POST['tolak'])){
				$data = array(
					'status_realisasi' => $status_realisasi2,
					'waktu_approve_realisasi' => $waktu_approve_realisasi,
					'keterangan_realisasi' => $keterangan_realisasi
				);
				$data2 = array(
					'status_realisasi' => $status_realisasi2,
					'waktu_approve_realisasi' => $waktu_approve_realisasi,
				);
				$where = array('id_approval' => $id_approval);
				$this->m_user->update_realisasi($where, $data2, 'tbl_rkb');
				$this->m_user->update_approval_realisasi($where, $data, 'tbl_approval_rkb');
				$this->session->set_flashdata('gagal_approve_realisasi', 'Realisasi sudah dikembalikan');
				redirect('user/approval_realisasi');
			}
		}
		else{
				$id_approval = $this->input->post('id_approval');
				$this->session->set_flashdata('error', 'Kolom Ketarangan Wajib diisi');
				redirect('user/detail_realisasi/'.$id_approval);
		}

		
	}

	public function riwayat_realisasi()
	{
		$nipp = $this->session->userdata('nipp');
		
		$data["riwayat"] = $this->m_user->get_riwayat_realisasi($nipp);
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('riwayat_realisasi', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function edit_realisasi($id_approval="")
	{
		$nipp = $this->session->userdata('nipp');
		$data["edit"] = $this->m_user->edit_realisasi($id_approval);
		$data["keterangan"] = $this->m_user->cek_keterangan($id_approval);
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('edit_realisasi', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function update_realisasi2()
	{
		$this->form_validation->set_rules('realisasi', 'Realisasi', 'trim|required');
		
		if($this->form_validation->run()==true)
		{
			$id_approval = $this->input->post('id_approval');
			$realisasi = $this->input->post('realisasi');
			$id_rkb = $this->input->post('id_rkb');
			$target = $this->input->post('target');
			$bobot = $this->input->post('bobot');
			$skor = ($realisasi/$target)*100;
			if($skor<75){
				$nilai = 1;
			}
			elseif($skor >= 75 AND $skor <= 89)
			{
				$nilai = 2;
			}
			elseif($skor >= 90 AND $skor <=110){
				$nilai = 3;
			}
			elseif($skor > 110)
			{
				$nilai = 4;
			}
			else{
				$nilai = 0;
			}
			
			$nilai_rkb = $bobot * $nilai;
			$waktu_realisasi = $this->input->post('waktu_realisasi');
			$bukti_realisasi = time().$_FILES["bukti_realisasi"]['name'];
			if($bukti_realisasi=''){}else{
				$config['upload_path'] = './assets/bukti_realisasi';
				$config['allowed_types'] = 'jpg|png|pdf|doc|docx|ppt|pptx|xls|xlsx|rar';
				$config['max_size'] = 2000;
				$config['encrypt_name'] = TRUE;
				$config['file_name'] = $bukti_realiasi;

				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('bukti_realisasi')){
					$this->session->set_flashdata('error_upload', 'File tidak dapat diupload. Upload file dengan ekstensi RAR, DOC, XLS, PPT, PDF, JPG, atau PNG dengan ukuran maksimum 2MB.');
					redirect('user/edit_realisasi/'.$id_approval);
				}
				else{
					$bukti_realisasi = $this->upload->data('file_name');
				}
			}

			$data = array(
				'realisasi' => $realisasi,
				'skor' => $skor,
				'nilai' => $nilai,
				'nilai_rkb' => $nilai_rkb,
				'waktu_realisasi' => $waktu_realisasi,
				'bukti_realisasi' => $bukti_realisasi						
			);
			$where = array('id_rkb' => $id_rkb);

			$this->m_user->input_realisasi($where, $data, 'tbl_rkb');
			$this->session->set_flashdata('sukses_input_realisasi', 'Realisasi berhasil diinput');
			redirect('user/edit_realisasi/'.$id_approval);
		}
		else{
			$id_approval = $this->input->post('id_approval');
			$this->session->set_flashdata('error', validation_errors());
            redirect('user/edit_realisasi/'.$id_approval);
		}
	}

	public function kirim_realisasi2()
	{
		$id_approval = $this->input->post('id_approval');
		$nilai_rkb = $this->input->post('nilai_rkb');
		$status_kirim_realisasi = "1";
		$status_realisasi = "0";
		$keterangan_realisasi = "";

		$data = array(
			'nilai_rkb' => $nilai_rkb,
			'status_realisasi' => $status_realisasi,
			'keterangan_realisasi' => $keterangan_realisasi
		);

		$data2 = array(
			'status_kirim_realisasi' => $status_kirim_realisasi,
			'status_realisasi' => $status_realisasi
		);

		$where = array('id_approval' => $id_approval);

		$this->m_user->kirim_realisasi_rkb($where, $data2, 'tbl_rkb');
		$this->m_user->kirim_realisasi_atasan($where, $data, 'tbl_approval_rkb');
		$this->session->set_flashdata('sukses_kirim_realisasi', 'Kirim Realisasi Berhasil. Realisasi Menunggu Approval Atasan');
		redirect('user/riwayat_realisasi');
	}

	public function detail_realisasi_rkb($id_approval="")
	{
		$nipp = $this->session->userdata('nipp');
		$where = array('id_approval'=>$id_approval, 'nipp'=>$nipp);
		$data["detail"] = $this->m_user->detail_rkb($where, 'tbl_rkb')->result();
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('detail_realisasi_rkb', $data);
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
		
	}

	public function print_realisasi($id_approval="")
	{
		//$id_approval = $this->input->post('id_approval');
		$nipp = $this->session->userdata('nipp');

		$query = $this->db->get_where('tbl_pegawai',array('nipp'=>$nipp));
		$data_user = $query->row();
		$kd_jabatan = $data_user->kd_jabatan;
		$kd_atasan = $data_user->kd_atasan;

		$where = array('id_approval'=>$id_approval);
		$data["pegawai"] = $this->m_user->get_pegawai($nipp);
		$data["nama_atasan"] = $this->m_user->get_nama_atasan($kd_atasan);
		$data["detail"] = $this->m_user->detail_rkb($where, 'tbl_rkb')->result();
		$data["jabatan"] = $this->m_user->get_jabatan($kd_jabatan);
		$data["atasan"] = $this->m_user->get_atasan($kd_atasan);
		$data["bulan"] = $this->m_user->get_bulan($id_approval);
		$this->load->view('print_realisasi', $data);
	}

	public function ganti_password()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/sitebar');
		$this->load->view('ganti_password');
		$this->load->view('includes/footer');
		$this->load->view('includes/js');
	}

	public function proses_ganti_password()
	{
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'trim|required');
		$this->form_validation->set_rules('ulang_pass_baru', 'Ulangi Password Baru', 'trim|required');

		if($this->form_validation->run()==true){
			$username = $this->session->userdata('username');
			$pass_lama	= $this->input->post('password_lama');
			$pass_baru = $this->input->post('password_baru');
			$ulangi_pass_baru = $this->input->post('ulang_pass_baru');

			if($this->m_user->cek_password($username, $pass_lama))
			{
				if($pass_baru!=$ulangi_pass_baru)
				{
					$this->session->set_flashdata('pass_beda', 'Password Baru yang dimasukkan tidak sama');
					redirect('user/ganti_password');
				}
				else{
					$where = array('username'=>$username);
					$data = array('password'=>password_hash($pass_baru, PASSWORD_DEFAULT));
					$this->m_user->update_password($where, $data, 'tbl_login');
					$this->session->set_flashdata('sukses', 'Ganti Password Berhasil');
					redirect('user/ganti_password');
				}
			}
			else{
				$this->session->set_flashdata('gagal', 'Password Lama Tidak Sesuai');
				redirect('user/ganti_password');
			}
		}
		else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('user/ganti_password');
		}
		
	}

	public function edit_kegiatan2()
	{
		$this->form_validation->set_rules('uraian', 'Uraian', 'trim|required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');

		if($this->form_validation->run()==true)
		{
			$id_approval = $this->input->post('id_approval');
			$id_rkb = $this->input->post('id_rkb');
			$uraian = $this->input->post('uraian');
			$bobot = $this->input->post('bobot');
			$target = $this->input->post('target');
			$satuan = $this->input->post('satuan');
			$waktu_rkb = $this->input->post('waktu_rkb');

			$data = array(
				'uraian' => $uraian,
				'bobot' => $bobot,
				'target' => $target,
				'satuan' => $satuan,
				'waktu_rkb' => $waktu_rkb
			);
			$where = array('id_rkb' => $id_rkb);

			$this->m_user->edit_kegiatan($where, $data, 'tbl_rkb');
			$this->session->set_flashdata('edit_rkb', 'Edit RKB Berhasil');
			//$url = $this->edit_rkb($id_approval);
			redirect('user/detail_rkb/'.$id_approval);
		}
		else{
			$id_approval = $this->input->post('id_approval');
			$this->session->set_flashdata('error', validation_errors());
            redirect('user/detail_rkb/'.$id_approval);
		}
	}

	public function update_realisasi3()
	{
		$this->form_validation->set_rules('realisasi', 'Realisasi', 'trim|required');
		//$this->form_validation->set_rules('bukti_realisasi', 'Bukti Realisasi', 'trim|required');
		
		if($this->form_validation->run()==true)
		{
			$id_approval = $this->input->post('id_approval');
			$realisasi = $this->input->post('realisasi');
			$id_rkb = $this->input->post('id_rkb');
			$target = $this->input->post('target');
			$bobot = $this->input->post('bobot');
			$skor = ($realisasi/$target)*100;
			if($skor >0 AND $skor<75){
				$nilai = 1;
			}
			elseif($skor >= 75 AND $skor <= 89)
			{
				$nilai = 2;
			}
			elseif($skor >= 90 AND $skor <=110){
				$nilai = 3;
			}
			elseif($skor > 110)
			{
				$nilai = 4;
			}
			else{
				$nilai = 0;
			}
			
			$nilai_rkb = $bobot * $nilai;
			$waktu_realisasi = $this->input->post('waktu_realisasi');
			
			$data = array(
				'realisasi' => $realisasi,
				'skor' => $skor,
				'nilai' => $nilai,
				'nilai_rkb' => $nilai_rkb,
				'waktu_realisasi' => $waktu_realisasi						
			);
			$where = array('id_rkb' => $id_rkb);

			$this->m_user->input_realisasi($where, $data, 'tbl_rkb');
			$this->session->set_flashdata('sukses_input_realisasi', 'Realisasi berhasil diinput');
			redirect('user/detail_realisasi/'.$id_approval);
		}
		else{
			$id_approval = $this->input->post('id_approval');
			$this->session->set_flashdata('error', validation_errors());
            redirect('user/detail_realisasi/'.$id_approval);
		}
	}

}
