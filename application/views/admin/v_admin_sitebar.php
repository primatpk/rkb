  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
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
          <a href="#" class="d-block">Ridho</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/direktorat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direktorat</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/divisi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Divisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/jabatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Database Pegawai
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pegawai</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/data_login" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Login</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>admin/monitoring_rkb" class="nav-link">
              <i class="nav-icon fas fa-desktop"></i>
              <p>Monitoring</p>
            </a>
      <!--      <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo base_url(); ?>admin/monitoring_rkb" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RKB</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php //echo base_url(); ?>admin/monitoring_realisasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realisasi RKB</p>
                </a>
              </li>
            </ul> -->
          </li>
   <!--       <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Ganti Password
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>