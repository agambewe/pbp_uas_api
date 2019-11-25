<?php
include('../db.php');
error_reporting(0);

$title = $_POST['title'];
$genre = $_POST['genre'];
$synopsis = $_POST['synopsis'];
$available = 1;
if(isset($_POST['image'])){
  $image = $_POST['image'];
}
$image = "http://andrewcmaxwell.com/wp-content/themes/acm_2014/images/book_not_found.png";


$query = mysqli_query($con,"INSERT INTO books(title,genre,synopsis,available,image) VALUES ('$title','$genre','$synopsis','$available','$image')");
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