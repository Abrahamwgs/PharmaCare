<?php

if(isset($_POST['reg']))
{
 
$med_id = $_POST['med_id'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$category = $_POST['category'];
$expiry = $_POST['expiry'];

include "conn.php";
$ins= "insert into medicines(med_id, name, quantity, price, category, expiry_date) 
       values ('$med_id', '$name', '$quantity', '$price', '$category', '$expiry')";
mysqli_select_db($con, "test1");
$res= mysqli_query($con,$ins);
if($res)
{
    header("Location: form.php?success=1");
    exit();
}
else{
    echo "error". mysql_error($con);
}
}

?>