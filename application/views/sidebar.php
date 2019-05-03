<?php $hak_akses = $this->session->userdata("hak_akses"); ?>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav">
            <a class="nav-link">
              Halo <?php echo $this->session->userdata("username");?>!
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="Dashboard"){echo 'active';}?>" href="<?php echo base_url('Dashboard'); ?>">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="Surat_baptis"){echo 'active';}?>" href="<?php echo base_url('Surat_baptis'); ?>">
              <span data-feather="file-plus"></span>
              Isi Surat Pembaptisan
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="Import_excel"){echo 'active';}?>" href="<?php echo base_url('Import_excel'); ?>">
              <span data-feather="file-plus"></span>
              Import data dari excel
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">

          <?php if($hak_akses & 1 == 1): ?>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="Data_user"){echo 'active';}?>" href="<?php echo base_url('Data_user') ?>">
              <span data-feather="users"></span>
              Data User
            </a>
          </li>
          <?php endif; ?>

          <?php if($hak_akses & 0b100 == 0b100): ?>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="Data_pastor"){echo 'active';}?>" href="<?php echo base_url('Data_pastor') ?>">
              <span data-feather="file-text"></span>
              Data Pastor
            </a>
          </li>
          <?php endif; ?>

          <?php if($hak_akses & 0b10 == 0b10): ?>
          <li class="nav-item">
            <a class="nav-link <?php if($this->uri->segment(1)=="Data_pembaptisan"){echo 'active';}?>" href="<?php echo base_url('Data_pembaptisan') ?>">
              <span data-feather="file-text"></span>
              Data Pembaptisan
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </div>
</div>
