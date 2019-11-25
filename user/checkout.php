<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include('../db.php');

    $seat = $_POST['seat'];
    $email = $_POST['email'];
    $currentBook = $_POST['currentBook'];

    $querys  = "UPDATE users SET seat=0, currentBook=0, isScanned=0 WHERE email='$email';";
    $querys .= "UPDATE seats SET available=1 WHERE id='$seat';";
    $querys .= "UPDATE books SET available=1 WHERE id='$currentBook';";


    $query = mysqli_multi_query($con, $querys) or die(mysqli_error($con));
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