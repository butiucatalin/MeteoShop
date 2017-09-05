<?php
  //setari baza de date
  ini_set('display_errors', 'On');

  try{
      $db = new PDO('mysql:host=127.0.0.1;dbname=meteoshop', 'root', '');
  } catch (Exception $e) {
      die('Conectare nereusita la baza de date.');
  }
