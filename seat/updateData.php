<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include('../db.php');

    $id = $_POST['id'];
    $seat = $_POST['seat'];

    $query = mysqli_query($con,"UPDATE seats SET seat='$seat' WHERE id='$id'")or die(mysqli_error($con));
    if($query) {
        $respose['code'] = 1;
        $respose['message'] = "Success update";
    }else{
        $respose['code'] = 0;
        $respose['message'] = "Failed update";
    }
}else{
    $respose['code'] = 0;
    $respose['message'] = "Illegal moving";
}
echo json_encode($respose);
?>