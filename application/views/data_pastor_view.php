
<?php
    include ('header.php');
    include ('sidebar.php');
?>

<script type="text/javascript">

  function isKosong(vnm){
      if (vnm.trim() != ""){
        return false;
      }
      return true;
  }

  function simpan(){
    var teks, mode, vid, vnl, vus, vps, vha, lok;
    var vha1,vha2,vha3;
    mode = $("#mode").val();
    switch (mode) {
      case "t": teks = "Data sudah benar?"; lok = "Data_pastor/tambah"; break;
      case "e": teks = "Data sudah benar?"; lok = "Data_pastor/edit"; break;
      case "h": teks = "Data akan dihapus?"; lok = "Data_pastor/hapus"; break;
    } // END Switch Case

    if (confirm(teks) == true) {
      vid = $("#id").val();
      if (mode != "h"){
        vid = $("#id").val();
        vnm = $("#nm").val();

        if(!isKosong(vnm)){
          $.ajax({
            url:"<?php echo base_url(); ?>"+lok,
            type: "post",
            data:{id:vid, nama:vnm},
            success: function(res){
              location.reload();
            }
          });
        } else{
          alert('Simpan dibatalkan karena ada field yang kosong!');
        }
      } else {
        $.ajax({
          url:"<?php echo base_url(); ?>"+lok+'/'+vid,
          type: "post",
          data:{id:vid},
          success: function(res){
            location.reload();
          }
        });
      } // END IF ELSE
    } else return false;  // END IF ELSE
  } // END FUNCTION

</script>



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data User</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-primary" onclick="tampil('t','','','')">
          Tambah
        </button>
      </div>
    </div>

    <div>
      
      <table id="tbl_user" class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>

        <tr>
          <th>ID</th>
          <th>Nama Pastor</th>
          <th>Operasi</th>
        </tr>
        </thead>
        <?php foreach ($users as $u) { ?>
        <tr>
          <td><?php echo $u->id; ?></td>
          <td><?php echo $u->nm_pastor; ?></td>
          <td>
            <div class="btn-group">
            <button class="btn btn-success" onclick="tampil('e','<?php echo $u->id; ?>','<?php echo $u->nm_pastor; ?>','<?php echo $u->tanda_tangan; ?>')">Edit</button>
            <button class="btn btn-danger" onclick="tampil('h','<?php echo $u->id; ?>','<?php echo $u->nm_pastor; ?>','<?php echo $u->tanda_tangan; ?>')">Delete</button>
            </div>
          </td>
        </tr>
        <?php } ?>

      </table>

    </div>
</main>

        <script type="text/javascript">
          function tampil(mode, id, nm, ttd){
            $('#mode').val(mode);
            $('#id').val(id);
            $('#nm').val(nm);
            $('#ttd').val(ttd);
            
            if (mode=='t'){
              $('#judul').html("Tambah Pastor");
              $("input").prop('disabled', false);
              $('#bs').html("Simpan");
            } else {
              if (mode=='e'){
                $('#judul').html("Edit Pastor");
                $("input").prop('disabled', false);
                $('#bs').html("Simpan");
              } else {
                $('#judul').html("Hapus Pastor");
                $("input").prop('disabled', true);
                $('#bs').html("Hapus");
              } // end IF ELSE
            } // end IF ELSE

            $('#myModalEdit').modal({backdrop: 'static', keyboard:false});
            $('#myModalEdit').modal('show');
            $('#nl').focus();
          } // END TAMPIL FUNCTION
        </script>

<!-- MODAL -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="judul">Judul</h3>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body">

        <table class="table table-striped table-bordered responsive">
          <tr style="display: none;">
            <td>Mode</td>
            <td><input id="mode" type="text" name="mode"></td>
          </tr>
          <tr style="display: none;">
            <td>ID</td>
            <td><input id="id" type="text" name="id"></td>
          </tr>
          <tr>
            <td>Nama Pastor</td>
            <td><input id="nm" type="text" name="nama"></td>
          </tr>
          <tr>
            <td>Tanda Tangan</td>
            <td>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="ttd" name="tanda_tangan"
                    aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="ttd">Choose file</label>
                </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-default" data-dismiss="modal">Tutup</a>
        <a id="bs" href="#" class="btn btn-primary" data-dismiss="modal" onclick="simpan()">Simpan</a>
      </div>
    </div>
  </div>
</div>



<?php
  include ('footer.php');
?>