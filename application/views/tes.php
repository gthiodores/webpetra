
<?php 
  $username = $this->session->userdata("username");
  $hak_akses = $this->session->userdata("hak_akses");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php echo $username.' '.$hak_akses.' '; ?>

</body>
</html>