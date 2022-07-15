  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>user" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/dist/img/logo-ptp.png"
           class="brand-image img-circle"
          >
      <span class="brand-text font-weight-light">RKB Online</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('nama') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                RKB
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>user/input_rkb" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input RKB</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>user/realisasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realisasi RKB</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
          <?php
            $nipp = $this->session->userdata('nipp');
            $query = $this->db->get_where('tbl_pegawai',array('nipp'=>$nipp));
            $data_user = $query->row();
            $kd_jabatan = $data_user->kd_jabatan;
            $status_rkb = "0";
            $status_realisasi = "0";
            $tot_rkb = $this->m_user->get_total_approval($kd_jabatan, $status_rkb);
            $result['tot_rkb'] = $tot_rkb;
            $tot_real = $this->m_user->get_total_approval_realisasi($kd_jabatan, $status_realisasi);
            $result['tot_real'] = $tot_real;
            $tot_riwayat_rkb = $this->m_user->get_tot_riwayat_rkb($nipp);
            $result["tot_riwayat_rkb"] = $tot_riwayat_rkb;
            $tot_riwayat_real = $this->m_user->get_tot_riwayat_real($nipp);
            $result["tot_riwayat_real"] = $tot_riwayat_real;

            $total_notif = $result['tot_rkb'] + $result['tot_real'];
            $total_notif2 = $result['tot_riwayat_rkb'] + $result['tot_riwayat_real'];

          ?>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>
                Approval
                <i class="right fas fa-angle-left"></i>
                <span id="tot_rkb" class="badge badge-info right"><?php 
                if($total_notif==0)
                echo "";
                else
                echo $total_notif; ?></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>user/approval" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval RKB</p><span id="tot_rkb" class="badge badge-info right"><?php 
                  if($result['tot_rkb']==0)
                  echo "";
                  else
                  echo  $result['tot_rkb']; ?></span>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>user/approval_realisasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approval Realisasi RKB</p><span id="tot_rkb" class="badge badge-info right"><?php 
                   if($result['tot_real']==0)
                   echo "";
                   else
                  echo  $result['tot_real']; ?></span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat
                <i class="right fas fa-angle-left"></i>
                <span id="tot_rkb" class="badge badge-info right"><?php 
                if($total_notif2==0)
                echo "";
                else
                echo $total_notif2; ?></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>user/riwayat_rkb" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat RKB</p><span class="badge badge-info right"><?php 
                   if($result['tot_riwayat_rkb']==0)
                   echo "";
                   else
                  echo  $result['tot_riwayat_rkb']; ?></span>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>user/riwayat_realisasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Realisasi RKB</p><span class="badge badge-info right"><?php 
                   if($result['tot_riwayat_real']==0)
                   echo "";
                   else
                  echo  $result['tot_riwayat_real']; ?></span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url(); ?>user/ganti_password" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Ganti Password
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>