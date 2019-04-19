<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php include('connection.php')?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Baptisan</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar"></span>
          This Year
        </button>
      </div>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    <script type="text/javascript">
      var month = new Array('Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember');
      var data_bulan = <?php echo json_encode($bulan_baptis); ?>;
      var label=[];
      var data =[];
      for (var key in data_bulan){
        var value = data_bulan[key];
        var nm_bulan = month[key-1];
        label.push(nm_bulan);
        console.log(nm_bulan+' '+value);
        data.push(value);
      }

      draw_graph('myChart', label, data, true);
      
    </script>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Penyerahan Anak</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar"></span>
          This Year
        </button>
      </div>
    </div>

    <canvas class="my-4 w-100" id="myChart2" width="900" height="380"></canvas>
    <script type="text/javascript">
      var label = ['Januari', 'Februari', 'Maret', 'April'];
      var data = [12, 15, 20, 17];
      draw_graph('myChart2', label, data, false);
    </script>

    <h2>Section title</h2>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Header</th>
            <th>Header</th>
            <th>Header</th>
            <th>Header</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1,001</td>
            <td>Lorem</td>
            <td>ipsum</td>
            <td>dolor</td>
            <td>sit</td>
          </tr>
          <tr>
            <td>1,002</td>
            <td>amet</td>
            <td>consectetur</td>
            <td>adipiscing</td>
            <td>elit</td>
          </tr>
          <tr>
            <td>1,003</td>
            <td>Integer</td>
            <td>nec</td>
            <td>odio</td>
            <td>Praesent</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

<?php include('footer.php') ?>
