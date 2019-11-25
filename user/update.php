<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include('../db.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $search = mysqli_query($con,"SELECT * FROM users WHERE email='$email' LIMIT 1")
        or die(mysqli_error($con));

    if($search){
        while($data = mysqli_fetch_assoc($search)){
            if(!(password_verify($password,$data['password']))){
                $respose['code'] = 0;
                $respose['message'] = "password salah bro";
                echo json_encode($respose);
                die();
            }
        }
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = mysqli_query($con,"UPDATE users SET name='$name', email='$email', password='$password' WHERE email='$email'")or die(mysqli_error($con));
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