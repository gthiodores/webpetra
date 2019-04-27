<?php
    include ('header.php');
    include ('sidebar.php');
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Surat Baptisan</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
<!--         <div class="btn-group mr-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar"></span>
          This Year
        </button> -->
      </div>
    </div>


    <form role="form">

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="nomor">No</label class="col-sm-1 col-form-label">
            <div class="col-sm-2">
                <p class="form-control"><?php echo $nomor; ?></p>    
            </div>
            
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="nama">Nama</label class="col-sm-1 col-form-label">
            <div class="col-sm-9">
                <p class="form-control"><?php echo $nama; ?></p> 
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="tempat_lahir">Lahir di</label class="col-sm-1 col-form-label">
            <div class="col-sm-4">
                <p class="form-control"><?php echo $tempat_lahir; ?></p> 
            </div>
            <label class="col-sm-1 col-form-label" for="tanggal_lahir">tanggal</label class="col-sm-1 col-form-label">
            <div class="col-sm-4">
                <p class="form-control"><?php echo $tgl_lahir; ?></p> 
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="nama_ayah">Ayah</label class="col-sm-1 col-form-label">
            <div class="col-sm-9">
                <p class="form-control"><?php echo $nm_ayah; ?></p> 
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="nama_ibu">Ibu</label class="col-sm-1 col-form-label">
            <div class="col-sm-9">
                <p class="form-control"><?php echo $nm_ibu; ?></p> 
            </div>
        </div>        

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="hari_baptis">Pada hari</label class="col-sm-1 col-form-label">
            <div class="col-sm-4">
                <p class="form-control"><?php echo $hari_baptis; ?></p> 
            </div>
            <label class="col-sm-1 col-form-label" for="tanggal_baptis">tanggal</label class="col-sm-1 col-form-label">
            <div class="col-sm-4">
                <p class="form-control"><?php echo $tgl_baptis; ?></p> 
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="oleh">Oleh</label class="col-sm-1 col-form-label">
            <div class="col-sm-9">
                <p class="form-control"><?php echo $nm_pastor; ?></p> 
            </div>
        </div>

        <button class="btn btn-info" onclick="">
          <!-- icon -->
          Lihat
        </button>
        <a class="btn btn-link" href="#">
          <!-- icon -->
          Download
        </a>
        <a class="btn btn-success" href="<?php echo base_url(); ?>Surat_baptis">Kembali</a> 
    </form>
</div>
</main>
   
<?php
  include ('footer.php');
?>