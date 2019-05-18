<?php
    include ('header.php');
    include ('sidebar.php');
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Surat Baptisan</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
      </div>
    </div>


    <form action="Surat_baptis/simpan" method="post" role="form" data-toggle="validator">

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="nomor">No</label>
            <div class="col-sm-2">
                <input class="form-control" type="text" name="nomor" id="nomor" value="<?php echo $nomor ?>" readonly  required="true" /> 
            </div>
            
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="nama">Nama</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" name="nama" id="nama" required="true" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="tempat_lahir">Lahir di</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" required="true" />
            </div>
            <label class="col-sm-1 col-form-label" for="tanggal_lahir">tanggal</label>
            <div class="col-sm-4">
                <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" required="true" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="alamat">Alamat</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" name="alamat" id="alamat" required="true" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="nama_ayah">Ayah</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" name="nama_ayah" id="nama_ayah" required="true" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="nama_ibu">Ibu</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" name="nama_ibu" id="nama_ibu" required="true" />
            </div>
        </div>        

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="hari_baptis">Pada hari</label>
            <div class="col-sm-4">   
                <input class="form-control" type="text" name="hari_baptis" id="hari_baptis" readonly="true"/>
            </div>
            <label class="col-sm-1 col-form-label" for="tanggal_baptis">tanggal</label>
            <div class="col-sm-4">
                <input class="form-control" type="date" name="tanggal_baptis" id="tanggal_baptis" required="true" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="oleh">Oleh</label>

            <!-- Mendaftarkan semua nama pastor yang ada pada database -->
            <div class="col-sm-9">
                <select class="form-control" name="oleh" id="oleh">
                    <?php foreach($pastors as $pastor) { ?>
                        <option value="<?php echo $pastor->nm_pastor; ?>"><?php echo $pastor->nm_pastor; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <button class="btn btn-success" type="submit">Submit</button> 
        <button class="btn btn-danger" type="reset">Reset</button>
    </form>
</div>
</main>

<script type="text/javascript">
    
    document.getElementById("tanggal_baptis").addEventListener("change", function() {
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
       
        document.getElementById("hari_baptis").value = weekday[d.getDay()];
    });
    
</script>
   
<?php
  include ('footer.php');
?>