<?php
include('../db.php');
error_reporting(0);

$id = $_POST['id'];
$query = mysqli_query($con,"SELECT * FROM books WHERE id = '$id'");

$delete = "DELETE FROM books WHERE id = '$id'";
$exedelete = mysqli_query($con,$delete);

$respose = array();
$rows = mysqli_num_rows($query);
if($rows > 0)
{
  if ($exedelete) {
    $respose['code'] = 1;
    $respose['message'] = "Deleted Success";
  }else{
    $respose['code'] = 0;
    $respose['message'] = "Failed to Delete";
  }
}else{
  $respose['code'] = 0;
  $respose['message'] = "Failed to Delete, data Not Found";
}

echo json_encode($respose);
?>