<?php
include('../db.php');
error_reporting(0);

$seat = $_POST['seat'];
$available = 1;

$query = mysqli_query($con,"INSERT INTO seats(seat,available) VALUES ('$seat','$available')");
$response = array();
if($query)
{
  $response['code'] =1;
  $response['message'] = "Success! Data Berhasil dimasukkan";
}else{
  $response['code'] =0;
  $response['message'] = "Failed! Data Gagal dimasukkan";
}

echo json_encode($response);

?>