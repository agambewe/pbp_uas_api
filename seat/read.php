<?php
include('../db.php');

$query = mysqli_query($con,"SELECT * FROM seat WHERE available=1") or die(mysqli_error($con));
$array_data = array();

while($data = mysqli_fetch_assoc($query)){
    $array_data['code'] = 1;
    $array_data['data'][] = $data;
}

echo json_encode($array_data);
?>