<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model
{
     //riwayat RKB
     var $tbl_approval_rkb = 'tbl_approval_rkb';
     var $column_order = array(null, 'bulan', 'tahun', 'status');
     var $column_search = array('bulan', 'tahun', 'status');
     var $order = array('tahun'=>'asc');

    public function get_rkb($nipp)
    {
        $status_rkb = "0";
        $status_kirim_rkb = "0";
        return $this->db->get_where('tbl_rkb', array('nipp' => $nipp, 'status_rkb'=>$status_rkb, 'status_kirim_rkb'=>$status_kirim_rkb));
       
        //return $this->db->get('tbl_rkb')->result();
    }   
    
    public function get_pegawai($nipp)
    {
        return $query = $this->db->get_where('tbl_pegawai',array('nipp'=>$nipp))->result();
    }

    public function cek_input_rkb($id_approval)
    {
        $status_kirim_rkb = "1";
        $query = $this->db->get_where('tbl_rkb',array('id_approval'=>$id_approval, 'status_kirim_rkb'=> $status_kirim_rkb));
        if($query->num_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function input_kegiatan($data)
    {
        $this->db->insert('tbl_rkb', $data);
    }

    public function edit_input_rkb($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus_rkb($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function kirim_rkb($data)
    {
        $this->db->insert('tbl_approval_rkb', $data);
    }

    public function update_kegiatan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_approval($kd_jabatan, $status_rkb)
    {
        return $this->db->get_where('tbl_approval_rkb',array('kd_atasan'=>$kd_jabatan,'status_rkb'=>$status_rkb));
    }
    
    public function detail_rkb($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_approval($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_riwayat_rkb($nipp)
    {
        return $this->db->get_where('tbl_approval_rkb',array('nipp'=>$nipp));
    }

    public function get_jabatan($kd_jabatan)
    {
        return $this->db->get_where('tbl_jabatan',array('kd_jabatan'=>$kd_jabatan))->result();
    }

    public function get_atasan($kd_atasan)
    {
        return $this->db->get_where('tbl_jabatan',array('kd_jabatan'=>$kd_atasan))->result();
    }

    public function get_nama_atasan($kd_atasan)
    {
        return $this->db->get_where('tbl_pegawai',array('kd_jabatan'=>$kd_atasan))->result();
    }

    public function get_bulan($id_approval)
    {
        return $this->db->get_where('tbl_approval_rkb', array('id_approval'=>$id_approval))->result();
    }

    public function edit_rkb($id_approval)
    {
        $status_rkb = "2";
        $status_kirim_rkb = "1";
        return $this->db->get_where('tbl_rkb', array('id_approval' => $id_approval, 'status_rkb'=>$status_rkb, 'status_kirim_rkb'=>$status_kirim_rkb));
    }

    public function cek_keterangan($id_approval)
    {
        return $this->db->get_where('tbl_approval_rkb', array('id_approval' => $id_approval));
    }

    public function edit_kegiatan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    
    public function update_kirim_rkb($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_realisasi($id_approval)
    {
       // $status_rkb = "1";
     //   $status_kirim_rkb = "1";
      //  $status_kirim_realisasi = "";
        return $this->db->get_where('tbl_rkb', array('id_approval' => $id_approval));
       
        //return $this->db->get('tbl_rkb')->result();
    }

    public function get_realisasi2($nipp)
    {
        $status_realisasi = "";
        $status_rkb = "1";
        return $this->db->get_where('tbl_approval_rkb', array('nipp' => $nipp, 'status_rkb'=>$status_rkb, 'status_realisasi'=>$status_realisasi));
       
        //return $this->db->get('tbl_rkb')->result();
    }

    public function input_realisasi($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function kirim_realisasi_rkb($where, $data2, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data2);
    }

    public function kirim_realisasi_atasan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_approval_realisasi($kd_jabatan, $status_realisasi)
    {
        return $this->db->get_where('tbl_approval_rkb',array('kd_atasan'=>$kd_jabatan,'status_realisasi'=>$status_realisasi));
    }

    public function detail_realisasi($id_approval, $status_realisasi)
    {
        return $this->db->get_where('tbl_rkb', array('id_approval'=>$id_approval, 'status_realisasi'=>$status_realisasi));
    }
    
    public function update_realisasi($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function update_approval_realisasi($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_riwayat_realisasi($nipp)
    {
        return $this->db->get_where('tbl_approval_rkb',array('nipp'=>$nipp));
    }

    public function edit_realisasi($id_approval)
    {
        $status_realisasi = "2";
        return $this->db->get_where('tbl_rkb', array('id_approval' => $id_approval, 'status_realisasi'=>$status_realisasi));
    }

    public function cek_password($username, $pass_lama)
    {
        $query = $this->db->get_where('tbl_login', array('username'=>$username));
        if($query->num_rows()>0)
        {
            $data_login = $query->row();
            if(password_verify($pass_lama, $data_login->password)){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
    }

    public function update_password($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_total_approval($kd_jabatan, $status_rkb)
    {
        $query = $this->db->get_where('tbl_approval_rkb',array('kd_atasan'=>$kd_jabatan,'status_rkb'=>$status_rkb));
        return $query->num_rows();
    }

    public function get_total_approval_realisasi($kd_jabatan, $status_realisasi)
    {
        $query = $this->db->get_where('tbl_approval_rkb',array('kd_atasan'=>$kd_jabatan,'status_realisasi'=>$status_realisasi));
        return $query->num_rows();
    }

    public function get_tot_riwayat_rkb($nipp)
    {
        $status_rkb = "2";
        $query = $this->db->get_where('tbl_approval_rkb',array('nipp'=>$nipp, 'status_rkb'=>$status_rkb));
        return $query->num_rows();
    }

    public function get_tot_riwayat_real($nipp)
    {
        $status_realisasi = "2";
        $query = $this->db->get_where('tbl_approval_rkb',array('nipp'=>$nipp, 'status_realisasi'=>$status_realisasi));
        return $query->num_rows();
    }

}
?>