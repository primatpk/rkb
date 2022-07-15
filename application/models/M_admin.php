<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model
{
    //jabatan
    var $tbl_jabatan = 'tbl_jabatan';
    var $column_order = array(null, 'kd_jabatan', 'kd_direktorat', 'kd_divisi', 'deskripsi', 'waktu_update');
    var $column_search = array('kd_jabatan', 'deskripsi','kd_direktorat', 'kd_divisi');
    var $order = array('kd_jabatan'=>'asc');

    //pegawai
    var $tbl_pegawai = 'tbl_pegawai';
    var $column_order2 = array(null,'nipp', 'kd_jabatan', 'kd_direktorat', 'kd_divisi', 'kd_atasan', 'nama', 'waktu_update');
    var $column_search2 = array('nipp', 'kd_jabatan', 'kd_direktorat', 'kd_divisi', 'kd_atasan', 'nama', 'waktu_update');
    var $order2 = array('kd_direktorat'=>'asc');

    //user
    var $tbl_login = 'tbl_login';
    var $column_order3 = array(null,'username', 'nama', 'nipp', 'level', 'waktu_update');
    var $column_search3 = array('username', 'nama', 'nipp', 'level', 'waktu_update');
    var $order3 = array('level'=>'asc');

    //monitoring_rkb
    //var $tbl_rkb = 'tbl_approval_rkb';
    //var $column_order4 = array(null, 'tbl_approval_rkb.nama', 'dekskripsi_divisi', 'deskripsi', 'status_rkb');
   // var $column_search4= array('nama', 'dekskripsi_divisi', 'deskripsi', 'status_rkb');
    var $order4 = array('id_approval'=>'asc');


    public function get_direktorat()
    {
        return $this->db->get('tbl_direktorat')->result();
    }

    public function input_direktorat($data)
    {
        $this->db->insert('tbl_direktorat', $data);
    }

    public function hapus_direktorat($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_direktorat($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_divisi()
    {
        return $this->db->get('tbl_divisi')->result();
    }

    public function input_divisi($data)
    {
        $this->db->insert('tbl_divisi', $data);
    }

    public function edit_divisi($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus_divisi($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_jabatan()
    {
        return $this->db->get('tbl_jabatan')->result();
    }

    public function input_jabatan($data)
    {
        $this->db->insert('tbl_jabatan', $data);
    }

    public function hapus_jabatan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_jabatan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function _get_datatables_query()
    {
        $this->db->from($this->tbl_jabatan);

        $i=0;

        foreach($this->column_search as $item)
        {
            if($_POST['search']['value'])
            {
                if($i==0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search)-1 == $i)
                $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
    }

    public function get_datatablesJabatan()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->tbl_jabatan);
        return $this->db->count_all_results();
    }

    //pegawai
    public function input_pegawai($data)
    {
        $this->db->insert('tbl_pegawai', $data);
    }

    public function cari_pegawai($nipp)
    {
        return $query= $this->db->get_where('tbl_pegawai',array('nipp'=>$nipp))->result();
    }

    public function _get_datatables_query2()
    {
        $this->db->from($this->tbl_pegawai);

        $i=0;

        foreach($this->column_search2 as $item)
        {
            if($_POST['search']['value'])
            {
                if($i==0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search2)-1 == $i)
                $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order2))
		{
			$order = $this->order2;
			$this->db->order_by(key($order), $order[key($order)]);
		}
    }

    public function get_datatablesPegawai()
    {
        $this->_get_datatables_query2();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered2()
    {
        $this->_get_datatables_query2();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all2()
    {
        $this->db->from($this->tbl_pegawai);
        return $this->db->count_all_results();
    }

    public function hapus_pegawai($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_pegawai()
    {
        return $this->db->get('tbl_pegawai')->result();
    }

    public function get_akses()
    {
        return $this->db->get('tbl_akses')->result();
    }

    //User
   
    public function _get_datatables_query3()
    {
        $this->db->from($this->tbl_login);

        $i=0;

        foreach($this->column_search3 as $item)
        {
            if($_POST['search']['value'])
            {
                if($i==0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search3)-1 == $i)
                $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order3))
		{
			$order = $this->order3;
			$this->db->order_by(key($order), $order[key($order)]);
		}
    }

    public function get_datatablesPengguna()
    {
        $this->_get_datatables_query3();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered3()
    {
        $this->_get_datatables_query3();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all3()
    {
        $this->db->from($this->tbl_login);
        return $this->db->count_all_results();
    }

    public function getLogin()
    {
        return $this->db->get('tbl_login')->result();
    }

    public function input_user($data)
    {
        $this->db->insert('tbl_login', $data);
    }

    public function hapus_login($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function detail_monitoring_rkb()
    {
        $this->db->select('*');
        $this->db->from('tbl_approval_rkb');
        $this->db->join('tbl_pegawai', 'tbl_approval_rkb.nipp = tbl_pegawai.nipp', 'left');
        $this->db->join('tbl_jabatan', 'tbl_approval_rkb.kd_jabatan = tbl_jabatan.kd_jabatan', 'left');
        $this->db->join('tbl_divisi', 'tbl_pegawai.kd_divisi = tbl_divisi.kd_divisi', 'left');
        $query =  $this->db->get()->result();
        return $query;

        //return $this->db->get_where('tbl_pegawai', array('kd_divisi'=>$kd_divisi));
    }

    public function edit_pegawai($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function edit_user($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function _get_datatables_query4()
    {

        //var $tbl_rkb = 'tbl_approval_rkb';
        $column_order4 = array(null, 'tbl_approval_rkb.nama', 'tbl_divisi.dekskripsi_divisi', 'tbl_jabatan.deskripsi', 'tbl_approval_rkb.status_rkb', 'tbl_approval_rkb.status_realisasi');
        $column_search4= array('tbl_approval_rkb.nama', 'tbl_divisi.deskripsi_divisi', 'tbl_jabatan.deskripsi', 'tbl_approval_rkb.status_rkb', 'tbl_approval_rkb.status_realisasi');
        //$order4 = array('id_approval_rkb'=>'asc');

        $this->db->select('*');
        $this->db->from('tbl_approval_rkb');
        $this->db->join('tbl_pegawai', 'tbl_approval_rkb.nipp = tbl_pegawai.nipp', 'left');
        $this->db->join('tbl_jabatan', 'tbl_approval_rkb.kd_jabatan = tbl_jabatan.kd_jabatan', 'left');
        $this->db->join('tbl_divisi', 'tbl_pegawai.kd_divisi = tbl_divisi.kd_divisi', 'left');

        $i=0;

        foreach($column_search4 as $item)
        {
            if($_POST['search']['value'])
            {
                if($i==0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($column_search4)-1 == $i)
                $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order4[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order4))
		{
			$order = $this->order4;
			$this->db->order_by(key($order), $order[key($order)]);
		}
    }

    public function get_datatablesrkb()
    {
        $this->_get_datatables_query4();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered4()
    {
        $this->_get_datatables_query4();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all4()
    {
        $this->db->from('tbl_approval_rkb');
        return $this->db->count_all_results();
    }

    public function cek_pegawai($nipp)
    {
        $query = $this->db->get_where('tbl_pegawai',array('nipp'=>$nipp));
        if($query->num_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function cek_login($username)
    {
        $query = $this->db->get_where('tbl_login',array('username'=>$username));
        if($query->num_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getLogin2($username)
    {
        return $query= $this->db->get_where('tbl_login',array('username'=>$username))->result();
    }
}
?>