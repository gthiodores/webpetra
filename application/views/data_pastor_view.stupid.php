
<?php
    include ('header.php');
    include ('sidebar.php');
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data Pastor</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <a type="button" class="btn btn-primary" href="Data_pastor/tambah_data">
          Tambah
        </a>
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
            <button class="btn btn-success" onclick="edit('<?php echo $u->id ?>','<?php echo $u->nm_pastor ?>','<?php echo $u->tanda_tangan ?>')">Edit</button>
            <button class="btn btn-danger" onclick="hapus('<?php echo $u->id ?>')">Delete</button>
            </div>
          </td>
        </tr>
        <?php } ?>

      </table>

    </div>
</main>


<script type="text/javascript">
  function edit(id,nama,ttd){
  
    $.ajax({
      url:'<?php echo base_url(); ?>'+'Data_pastor/edit_data',
      type: "post",
      data:{id:id,nama:nama,ttd:ttd},
      success: function(res){
        location.reload();
      }  
    });
    
  }
  function hapus(vid){
    if(confirm("Hapus data?")){
      $.ajax({
        url:'<?php echo base_url(); ?>'+'Data_pastor/hapus',
        type: "post",
        data:{id:vid},
        success: function(res){
          location.reload();
        }  
      });
    }
  }
</script>

<?php
  include ('footer.php');
?>