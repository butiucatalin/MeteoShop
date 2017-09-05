<?php
  //setari baza de date
  $dbHost = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbName = 'meteoshop';

  $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

  if($db->connect_error) {
      die("Conexiune nereusita la baza de date : " . $db->connect_error);
  }
