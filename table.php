<?php
include "conn.php";
$tb1= "create table medicines(
    med_id int primary key, 
    name varchar(50), 
    quantity int, 
    price decimal(10,2),
    category varchar(20),
    expiry_date date
)";
mysqli_select_db($con, "test1");
$res= mysqli_query($con, $tb1);
if ($res){
echo "table created";


}

?>

