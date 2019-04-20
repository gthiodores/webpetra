
<?php
    include ('header.php');
    include ('sidebar.php');
?>

<script type="text/javascript">

  function isKosong(input){
    for(var v in input){
      if (v.trim() != "") {
        return false;
      }
    }
      return true;
  }

  function simpan(){
    var teks, mode, vid, vnomor, vnama, vtplahir, vtglahir, vayah, vibu, vhrbaptis, vtgbaptis, voleh;
    mode = $("#mode").val();
    switch (mode) {
      // case "t": teks = "Data sudah benar?"; lok = "Data_pembaptisan/tambah"; break;
      case "e": teks = "Data sudah benar?"; lok = "Data_pembaptisan/edit"; break;
      case "h": teks = "Data akan dihapus?"; lok = "Data_pembaptisan/hapus"; break;
    } // END Switch Case

    if (confirm(teks) == true) {
      vid = $("#id").val();
      if (mode != "h"){

        vid = $("#nomor").val();
        vnomor = $("#nomor").val();
        vnama = $("#nama").val();
        vtplahir = $("#tplahir").val();
        vtglahir = $("#tglahir").val();
        vayah = $("#ayah").val();
        vibu = $("#ibu").val();
        vhrbaptis = $("#hrbaptis").val();
        vtgbaptis = $("#tgbaptis").val();
        voleh = $("#oleh").val();

        vinput = [vnomor,vnama,vtplahir,vtglahir,vayah,vibu,vhrbaptis,vtgbaptis,voleh];

        if(!isKosong(vinput)){
          $.ajax({
            url:"<?php echo base_url(); ?>"+lok,
            type: "post",
            data:{id:vid, nomor:vnomor, nama:vnama, tplahir:vtplahir, tglahir:vtglahir, ayah:vayah, ibu:vibu, hrbaptis:vhrbaptis, tgbaptis:vtgbaptis, oleh:voleh},
            success: function(res){
              location.reload();
            }
          });
        } else{
          alert('Simpan dibatalkan karena ada field yang kosong!');
        }
      } else {
        $.ajax({
          url:"<?php echo base_url(); ?>"+lok,
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
      <h1 class="h2">Data Pembaptisan</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <a type="button" class="btn btn-primary" href="<?php echo base_url('Surat_baptis'); ?>">
          <!-- icon -->
          Tambah
        </a>
      </div>
    </div>

    <div>
      
      <table id="tbl_user" class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>

        <tr>
          <th>Nomor</th>
          <th>Nama</th>
          <!-- <th>Tempat Lahir</th>
          <th>Tanggal Lahir</th>
          <th>Nama Ayah</th>
          <th>Nama Ibu</th>
          <th>Hari Baptis</th> -->
          <th>Tanggal Baptis</th>
          <th>Oleh</th>
          <th>Operasi</th>
        </tr>
        </thead>
        <?php foreach ($dt_baptis as $d) { ?>
        <tr>
          <td><?php echo $d->nomor; ?></td>
          <td><?php echo $d->nama; ?></td>
          <td><?php echo $d->tgl_baptis; ?></td>
          <td><?php echo $d->nm_pastor; ?></td>
          <td>
            <div class="btn-group">
            <button class="btn btn-info" onclick="lihat_pdf('<?php echo $d->file_surat; ?>')">
              <!-- icon -->
              Lihat
            </button>
            <a href="<?php echo base_url("uploads/").$d->file_surat.".pdf"; ?>" class="btn btn-link">
              <!-- icon -->
              Download
            </a>
            <button class="btn btn-success" onclick="
            tampil('e','<?php echo $d->nomor; ?>','<?php echo $d->nomor; ?>','<?php echo $d->nama; ?>',
              '<?php echo $d->tempat_lahir; ?>','<?php echo $d->tgl_lahir; ?>','<?php echo $d->nm_ayah; ?>',
              '<?php echo $d->nm_ibu; ?>','<?php echo $d->hari_baptis; ?>','<?php echo $d->tgl_baptis; ?>',
              '<?php echo $d->nm_pastor; ?>')">
              <!-- icon -->
              Edit
            </button>
            <button class="btn btn-danger" onclick="
            tampil('h','<?php echo $d->nomor; ?>','<?php echo $d->nomor; ?>','<?php echo $d->nama; ?>',
              '<?php echo $d->tempat_lahir; ?>','<?php echo $d->tgl_lahir; ?>','<?php echo $d->nm_ayah; ?>',
              '<?php echo $d->nm_ibu; ?>','<?php echo $d->hari_baptis; ?>','<?php echo $d->tgl_baptis; ?>',
              '<?php echo $d->nm_pastor; ?>')">
              <!-- icon -->
              Delete
            </button>
              </div>
          </td>
        </tr>
        <?php } ?>

      </table>

    </div>
</main>

        <script type="text/javascript">
          function tampil(mode, id, nomor, nama, tplahir, tglahir, ayah, ibu, hrbaptis, tgbaptis, oleh){
            $('#mode').val(mode);
            $("#id").val(id);
            $("#nomor").val(nomor);
            $("#nama").val(nama);
            $("#tplahir").val(tplahir);
            $("#tglahir").val(tglahir);
            $("#ayah").val(ayah);
            $("#ibu").val(ibu);
            $("#hrbaptis").val(hrbaptis);
            $("#tgbaptis").val(tgbaptis);
            $("#oleh").val(oleh);
            
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

          // membuat file pdf
          function buat_pdf(nomorsurat,nama,tplahir, tglahir, ayah, ibu, hrbaptis, tgbaptis, oleh){
              $('#judul_surat').html("Surat Nomor: "+nomorsurat);
              $('#myModalLihatSurat').modal({backdrop: 'static', keyboard:false});
              $('#myModalLihatSurat').modal('show');
              $("#iframe123").prop("src","<?php echo base_url('Surat_baptis/lihat_surat/'); ?>"+nomorsurat+"/"
              +nama.replace(/\s+/g, '_')+"/"+tplahir.replace(/\s+/g, '_')+"/"+tglahir+"/"+ayah.replace(/\s+/g, '_')+"/"+ibu.replace(/\s+/g, '_')+"/"+hrbaptis.replace(/\s+/g, '_')+"/"+tgbaptis+"/"+oleh.replace(/\s+/g, '_'));
              $('#nl').focus();

          }

          // melihat file pdf
          function lihat_pdf(namafile) {
            console.log(namafile);
            $('#judul_surat').html("Surat Nomor: "+namafile);
            $('#myModalLihatSurat').modal({backdrop: 'static', keyboard:false});
            $('#myModalLihatSurat').modal('show');
            $("#iframe123").prop("src","<?php echo base_url('Surat_baptis/tampilkan_surat/');?>"+namafile);
          }

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
            <td>Nomor</td>
            <td><input id="nomor" type="text" name="nomor"></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td><input id="nama" type="text" name="nama"></td>
          </tr>
          <tr>
            <td>Tempat Lahir</td>
            <td><input id="tplahir" type="text" name="tplahir"></td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td><input id="tglahir" type="date" name="tglahir"></td>
          </tr>
          <tr>
            <td>Ayah</td>
            <td><input id="ayah" type="text" name="ayah"></td>
          </tr>
          <tr>
            <td>Ibu</td>
            <td><input id="ibu" type="text" name="ibu"></td>
          </tr>
          <tr style="display:none">
            <td>Hari Baptis</td>
            <td>               
              <select name="hrbaptis" id="hrbaptis">
                <option value="0">Minggu</option>
                <option value="1">Senin</option>
                <option value="2">Selasa</option>
                <option value="3">Rabu</option>
                <option value="4">Kamis</option>
                <option value="5">Jumat</option>
                <option value="6">Sabtu</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Tanggal Baptis</td>
            <td><input id="tgbaptis" type="date" name="tgbaptis"></td>
          </tr>
          <tr>
            <td>Oleh</td>
            <td><input id="oleh" type="text" name="oleh"></td>
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

<!-- Modal untuk pdf -->
<div class="modal fade" id="myModalLihatSurat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="judul_surat">Judul</h3>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body">
          <iframe id="iframe123" src="" scrolling="yes" frameborder="0"
    style="position: relative; height: 720px; width: 100%;"></iframe>

      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-default" data-dismiss="modal">Tutup</a>
      </div>
    </div>
  </div>
</div>
<!-- end -->

<script type="text/javascript">
    document.getElementById("tgbaptis").addEventListener("change", function() {
        var input = this.value;
        var d = new Date(input);
        var weekday = new Array(7);

        weekday[0] = "Minggu";
        weekday[1] = "Senin";
        weekday[2] = "Selasa";
        weekday[3] = "Rabu";
        weekday[4] = "Kamis";
        weekday[5] = "Jumat";
        weekday[6] = "Sabtu";
       
        document.getElementById("hrbaptis").selectedIndex = d.getDay();
    });
</script>

<?php
  include ('footer.php');
?>