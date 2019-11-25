<?php
include('../db.php');

if(isset($_GET['id'])){

    $id = $_GET['id'];
    
    $query = mysqli_query($con,"SELECT * FROM seats WHERE id = '$id' ") or die(mysqli_error($con));
    $array_data = array();
    
    while($data = mysqli_fetch_assoc($query)){
        $array_data['code'] = 1;
        $array_data['data'][] = $data;
    }
}else{
    $array_data['code'] = 0;
}
echo json_encode($array_data);
?>