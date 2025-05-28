<?php
include 'conn.php';

$id = $_GET['id'];
$qry = "DELETE FROM medicines WHERE med_id = $id";

if (mysqli_query($con, $qry)) {
    header("Location: med_list.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}

mysqli_close($con);
?>