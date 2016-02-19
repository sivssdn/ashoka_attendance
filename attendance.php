<?php
 date_default_timezone_set("Asia/Kolkata");
 header("Content-type:application/json");
  
 $uid=htmlspecialchars($_GET['uid']);
 $db=new PDO("mysql:host=localhost;dbname=ugs","root","server");
  $data=$db->prepare("SELECT `name` FROM `ashoka_ugs` WHERE `card_number` LIKE '{$uid}';");
  $data->execute();
  $result=$data->fetch();
  $hours=date('H');
  $min=date('i');
  //$sec=date('c');
	 print("{name:'{$result[0]}',hour:'{$hours}',min:'{$min}'}");
  $db=null;

?>
