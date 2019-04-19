<?php

	//function untuk membuat tabel data_baptis
	function createTableDataBaptis($link){
		$link->query("CREATE TABLE data_baptis (
          nomor varchar(16) NOT NULL,
          nama varchar(50) NOT NULL,
          tempat_lahir varchar(20) NOT NULL,
          tgl_lahir date NOT NULL,
          nm_ayah varchar(50) NOT NULL,
          nm_ibu varchar(50) NOT NULL,
          hari_baptis tinyint(1) NOT NULL,
          tgl_baptis date NOT NULL,
          nm_pastor varchar(50) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
	}

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gpetra";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    // Check connection
    if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	// Cek jika database ada atau tidak,
	// jika tidak, maka database akan dibuat
	$db_select = mysqli_select_db($conn,$dbname);
	if(!$db_select){

		$conn->query("CREATE DATABASE ".$dbname);

	}

	// hubungkan $conn dengan database
	$conn = mysqli_connect($servername, $username, $password,$dbname);
    if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	// cek jika tabel ada atau tidak
    if (!$result = $conn->query("SHOW TABLES LIKE data_baptis")) {
        createTableDataBaptis($conn);
    }

?>