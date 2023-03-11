<?php
  $connection = mysqli_connect("localhost","root","","qalam_mis_dental_version");
  mysqli_set_charset($connection,"utf8");

  if($connection)
  {

  }
  else
  {
    header("location:500.html");
  }
 ?>
