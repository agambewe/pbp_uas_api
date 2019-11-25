<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include('../db.php');

    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = mysqli_query($con,"SELECT * FROM users WHERE email = '$email' Limit 1" ) or die (mysqli_error($con));
    if(mysqli_num_rows($query) == 0){
        {
            $respose['code'] = 0;
            $respose['message'] = "Email tidak ditemukan.";
        }
    }else{
        $user = mysqli_fetch_assoc($query);
        if(password_verify($password,$user['password'])){
            if($user['status']==0){
                {
                    $respose['code'] = 0;
                    $respose['message'] = "akun belum teraktivasi, silahkan cek email anda untuk melakukan aktivasi.";
                }
                echo json_encode($respose);
                die();
            }
                $respose['code'] = 1;
                $respose['message'] = "Sukses login.";
        }else{
            $respose['code'] = 0;
            $respose['message'] = "Email or Password Invalid.";
        }
    }
}else{
    $respose['code'] = 0;
    $respose['message'] = "Illegal moving";
}
echo json_encode($respose);
?>