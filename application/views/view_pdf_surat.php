<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <?php $nama_hari = array(
                      0=>"Minggu",
                      1=>"Senin",
                      2=>"Selasa",
                      3=>"Rabu",
                      4=>"Kamis",
                      5=>"Jumat",
                      6=>"Sabtu"
                     ) ?>
  <body>
        <?php echo $nomor_surat; ?> <br />
        <?php echo $nama_penerima; ?>     <br />
        <?php echo $tempat_lahir;?><br />
        <?php echo $tanggal_lahir;?><br />

    <?php echo $ayah;?><br />
    <?php echo $ibu;?><br />
    <?php echo $nama_hari[$hari_baptis];?><br />
    <?php echo $tgl_baptis;?><br />
    <?php echo $oleh;?><br />
  </body>
</html>
