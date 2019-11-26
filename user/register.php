<?php
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");
require("../PHPMailer/src/Exception.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();

if(isset($_POST['name'])){
    include('../db.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $hash = md5(rand(0,1000));
    $status = 0;
    $seat = "0";
    $currentBook = "0";
    $isScanned = 0;

    $base_url = "http://pbp.api.drugsative.xyz/user/";
    $toko ="staff@pbp.gov";
    $mail_body = "
    <p>Hai ".$name.",</p>
    <p>Terimakasih sudah mendaftar pada ".$toko."</p>
    <button><a href=".$base_url."verify.php?email=".$email."&hash=".$hash.">Klik disini untuk verifikasi</a></button>
    <p>Enjoyyy ~</p>
    ";
            
    mail($email,"[VERIF BRO]", $mail_body, "FROM:" . $toko);
    $respose['code'] = 1;
    $respose['message'] = "Daftar selesai , Silahkan cek email anda.";
    $input = mysqli_query($con,"INSERT INTO users(name,email,password,hash,status,seat,currentBook,isScanned) 
    VALUES('$name','$email','$password','$hash','$status','$seat','$currentBook','$isScanned')")or die(mysqli_error($con));
}
//             $respose['code'] = 0;
//             $respose['message'] = "Daftar gagal.";
// }else{
//     $respose['code'] = 0;
//     $respose['message'] = "Illegal moving";
// }

echo json_encode($respose);
?>