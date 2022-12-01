<?php
  $server_name = "localhost";
  $username = "root";
  $password = "";
  $database_name = "sap_axim";

  // connection
  $connection = mysqli_connect($server_name, $username, $password, $database_name);

  if (!$connection){
    die("Connection failed: " . mysqli_connect_error());
  }

 