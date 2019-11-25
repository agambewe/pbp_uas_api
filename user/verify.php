<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $respose['code'] = 0;
    $respose['message'] = "Email tidak benar.";
        if(isset($_GET['email']) && isset($_GET['hash'])){
            include('../db.php');

            $email = $_GET['email'];
            $hash = $_GET['hash'];

            $search = mysqli_query($con,"SELECT * FROM users WHERE email='$email' LIMIT 1")
            or die(mysqli_error($con));

            if($search){
                while($data = mysqli_fetch_assoc($search)){
                    if($data['hash']==$hash){
                        $input = mysqli_query($con,"UPDATE users SET status=1 WHERE email='$email'")
                        or die(mysqli_error($con));
                        $respose['code'] = 1;
                        $respose['message'] = "Sukses aktivasi akun.";
                    }else{
                        $respose['code'] = 0;
                        $respose['message'] = "Hash tidak benar.";
                    }
                }
            }
        }else{
            $respose['code'] = 0;
            $respose['message'] = "Illegal moving";
        }
    }
echo json_encode($respose);
?>