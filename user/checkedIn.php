<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include('../db.php');

    $email = $_POST['email'];

    $query = mysqli_query($con,"UPDATE users SET isScanned=1 WHERE email='$email'")or die(mysqli_error($con));
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