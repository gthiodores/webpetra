<?php require 'header.php';
			require 'sidebar.php';?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data Pastor Input</h1>
      <div class="btn-toolbar mb-2 mb-md-0">

      </div>
    </div>

    <div>
    		<div class="wrapper">
          <?php
            
            echo form_open_multipart("Data_pastor/proses");
          ?>  
            <div class="form-group row" style="display: none;">
              <label class="col-sm-1 col-form-label" for="id">ID</label>
              <div class="col-sm-9">
                  <input class="form-control" name="id" id="id"
                    value="<?php echo $pastor->id; ?>"/>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="nama">Nama Pastor</label>
              <div class="col-sm-7">
                <input style="display: none;" class="form-control" name="nama" id="nama"
                    value="<?php echo $pastor->nm_pastor; ?>"/>
                  <p class="form-control" id="nama"><?php echo $pastor->nm_pastor; ?></p>
              </div>
            </div>

          <?php
            echo '<div class="form-group">';
            echo '<label>Tanda tangan (file harus berbentuk .png) ' . '</label>'; // show error judul
            // echo '</div>';
            // echo '<div class="form-group">';
            // echo '<label>' . $error . '</label>'; // show error upload
            echo '<br />';
            echo form_upload('userfile');
            echo '</div>';
            // echo form_submit('mysubmit', 'Upload', 'class="btn btn-primary"');
            echo "<input type='submit' name='submit' value='upload' class='btn btn-primary'/>";
            echo form_close();
          ?>
        </div>
    </div>

</main>



<?php require 'footer.php'; ?>
