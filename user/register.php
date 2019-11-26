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

    $base_url = "http://localhost/pbp_uas/user/";
    $toko ="AreKKaoS";
    $mail_body = "
    <p>Hai ".$name.",</p>
    <p>Terimakasih sudah mendaftar pada ".$toko."</p>
    <button><a href=".$base_url."verify.php?email=".$email."&hash=".$hash.">Klik disini untuk verifikasi</a></button>
    <p>Enjoyyy ~</p>
    ";
        $mail->SMTPDebug = 2;  
        $mail->IsSMTP();        //Sets Mailer to send message using SMTP
        $mail->Host = 'staff@web.drugsative.xyz';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
        $mail->Port = 587;        //Sets the default SMTP server port
        $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
        // $mail->Username = 'arekkaos@gmail.com';     //Sets SMTP username
        // $mail->Password = 'Arek_Kaos!#';     //Sets SMTP password
        $mail->Username = 'drugsati_agam';
        $mail->Password = 'PAW_ICONIC!';
        $mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
        $mail->From = 'staff@arekkaos.com';   //Sets the From email address for the message
        $mail->FromName = $toko;     //Sets the From name of the message
        $mail->AddAddress($email, $name);  //Adds a "To" address   
        $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
        $mail->IsHTML(true);       //Sets message type to HTML    
        $mail->Subject = 'Email Verification';   //Sets the Subject of the message
        $mail->Body = $mail_body;       //An HTML or plain text message body
        if($mail->Send())        //Send an Email. Return true on success or false on error
        {
            $respose['code'] = 1;
            $respose['message'] = "Daftar selesai , Silahkan cek email anda.";
            $input = mysqli_query($con,"INSERT INTO users(name,email,password,hash,status,seat,currentBook,isScanned) 
    VALUES('$name','$email','$password','$hash','$status','$seat','$currentBook','$isScanned')")or die(mysqli_error($con));
        }else{
            $respose['code'] = 0;
            $respose['message'] = "Daftar gagal.";
            echo json_encode($mail->ErrorInfo);
        }
}else{
    $respose['code'] = 0;
    $respose['message'] = "Illegal moving";
}

echo json_encode($respose);
?>