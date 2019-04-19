
<?php
    include ('header.php');
    include ('sidebar.php');
?>

<script type="text/javascript">

  function isKosong(vus,vps){
      if (vus.trim() != "" && vps.trim() != "") {
        return false;
      }
      return true;
  }

  function simpan(){
    var teks, mode, vid, vnl, vus, vps, vha, lok;
    var vha1,vha2,vha3;
    mode = $("#mode").val();
    switch (mode) {
      case "t": teks = "Data sudah benar?"; lok = "Data_user/tambah"; break;
      case "e": teks = "Data sudah benar?"; lok = "Data_user/edit"; break;
      case "h": teks = "Data akan dihapus?"; lok = "Data_user/hapus"; break;
    } // END Switch Case

    if (confirm(teks) == true) {
      vid = $("#id").val();
      if (mode != "h"){
        vus = $("#us").val();
        vps = $("#ps").val();

        vha1 = (($('#ha1').is(':checked'))? (Number($("#ha1").val())):0);
        vha2 = (($('#ha2').is(':checked'))? (Number($("#ha2").val())):0);
        vha3 = (($('#ha3').is(':checked'))? (Number($("#ha3").val())):0);
        vha = vha1+vha2+vha3;
        if(!isKosong(vus,vps)){
          $.ajax({
            url:"<?php echo base_url(); ?>"+lok,
            type: "post",
            data:{id:vid, username: vus, password: vps, hak_akses: vha},
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
          <th>Username</th>
          <th>Password</th>
          <th>Hak Akses</th>
          <th>Operasi</th>
        </tr>
        </thead>
        <?php foreach ($users as $u) { ?>
        <tr>
          <td><?php echo $u->username; ?></td>
          <td><?php echo $u->password; ?></td>
          <td><?php echo $u->hak_akses; ?></td>
          <td>
            <div class="btn-group">
            <button class="btn btn-success" onclick="tampil('e','<?php echo $u->username; ?>','<?php echo $u->username; ?>','<?php echo $u->hak_akses; ?>')">Edit</button>
            <button class="btn btn-danger" onclick="tampil('h','<?php echo $u->username; ?>','<?php echo $u->username; ?>','<?php echo $u->hak_akses; ?>')">Delete</button>
            </div>
          </td>
        </tr>
        <?php } ?>

      </table>

    </div>
</main>

        <script type="text/javascript">
          function tampil(mode, id, us, ha){
            $('#mode').val(mode);
            $('#id').val(id);
            $('#us').val(us);

            
            if(ha & 1){
              $('#ha1').prop('checked', true);
            } else{
              $('#ha1').prop('checked', false);
            } 
            if(ha & 2){              
              $('#ha2').prop('checked', true);
            } else {
              $('#ha2').prop('checked', false); 
            }
            if(ha & 4){
              $('#ha3').prop('checked', true);  
            } else{
              $('#ha3').prop('checked', false);
            }

            console.log(ha & 2);
            
            if (mode=='t'){
              $('#judul').html("Tambah User");
              $("input").prop('disabled', false);
              $('#bs').html("Simpan");
            } else {
              if (mode=='e'){
                $('#judul').html("Edit User");
                $("input").prop('disabled', false);
                $('#bs').html("Simpan");
              } else {
                $('#judul').html("Hapus User");
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
            <td>Nama User</td>
            <td><input id="us" type="text" name="username"></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input id="ps" type="password" name="password"></td>
          </tr>
          <tr>
            <td>Hak Akses</td>
            <td>
              <div class="checkbox">
                <label><input id="ha1" type="checkbox" name="hak_akses" value="1"> Tabel Data User</label>
              </div>
              <div class="checkbox">
                <label><input id="ha2" type="checkbox" name="hak_akses" value="2"> Tabel Data Pembaptisan</label>
              </div>
              <div class="checkbox">
                <label><input id="ha3" type="checkbox" name="hak_akses" value="4"> Input Data Pembaptisan</label>
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