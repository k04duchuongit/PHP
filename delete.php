<?php
require 'connect.php';
 $idDelete = $_GET['flight_id'];
 $sql = "DELETE FROM flights WHERE flight_id= '$idDelete'";
 $conn ->exec($sql);
 header('Location:./index.php');
 ?>
