<?php
include('../db.php');
include('../PHPQRcode/qrlib.php');
error_reporting(0);

$id = $_POST['id'];
$email = $_POST['email'];
if(isset($_POST['currentBook'])){
  $currentBook = $_POST['currentBook'];
}else{
  $currentBook = "empty";
}

//user
$query_users = mysqli_query($con,"SELECT * FROM users WHERE email='$email'") or die(mysqli_error($con));
        if($query_users){
          while($data_users = mysqli_fetch_assoc($query_users)){
            $id_old = $data_users['currentBook'];
            $seat = $data_users['seat'];
            if($id_old!="empty"){
              $update_old = "UPDATE books SET available=1 WHERE id='$id_old'";
              $exequery_old = mysqli_query($con,$update_old);
            }
            
            if($seat!="empty" && $id_old!="empty"){
              $fileName = "../user/QRcode/".$email.".png";
              QRcode::png($email, $fileName, "M", 4, 4);
                $dataImage = "http://localhost/pbp_uas/user/QRcode/".$email.".png";
            }else{
                $dataImage = "https://cdn1.iconfinder.com/data/icons/browser-5/100/ui-brower-go-24-512.png";
            }

        }
      }

$query = mysqli_query($con,"SELECT * FROM books WHERE id = '$id' ") or die(mysqli_error($con));
if($query){
  while($data = mysqli_fetch_assoc($query)){
    if($data['available']==0){
      // $update = "UPDATE books SET available=1 WHERE id='$id'";
      // $updt_usr = "UPDATE users SET currentBook='$currentBook' WHERE email='$email'";
    }else{
      $update = "UPDATE books SET available=0 WHERE id='$id'";
      $updt_usr = "UPDATE users SET currentBook='$currentBook', image='$dataImage' WHERE email='$email'";
    }
  }
}
$exequery = mysqli_query($con,$update);
$exequery_usr = mysqli_query($con,$updt_usr);
$respose = array();
$rows = mysqli_num_rows($query);
if($rows > 0)
{
  if($exequery)
  {
    $respose['code'] = 1;
    $respose['message'] = "Updated Sukses";
  }else{
    $respose['code'] = 0;
    $respose['message'] = "Updated Gagal";
  }

  if($exequery_usr)
  {
    $respose['code'] = 1;
    $respose['message'] = "Updated usr Sukses";
  }else{
    $respose['code'] = 0;
    $respose['message'] = "Updated usr Gagal";
  }
}else{
  $respose['code'] = 0;
  $respose['message'] = "Updated Galal, Data yang dipilih tidak ada";
}
echo json_encode($respose);
?>