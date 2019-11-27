<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include('../db.php');

    $seat = $_POST['seat'];
    $email = $_POST['email'];
    $currentBook = $_POST['currentBook'];
    
    $search = mysqli_query($con,"SELECT * FROM users WHERE email='$email' LIMIT 1")
        or die(mysqli_error($con));

    if($search){
        while($data = mysqli_fetch_assoc($search)){
            if($data['seat']!=0 && $data['currentBook']!=0){
                $input = mysqli_query($con,"INSERT INTO logs(name,email,seat,currentBook) 
    SELECT name, email, seat, currentBook FROM users")or die(mysqli_error($con));
            }
        }
    }

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