<?php
include "conn.php";
$sql= "create database Test1";
$res = mysqli_query($con,$sql);
if ($res){
echo "db created";
}
 else {
echo "erroe in creating db";

 }
 ?>