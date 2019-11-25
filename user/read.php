<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $respose['code'] = 0;
    $respose['message'] = "Email tidak benar.";
        if(isset($_GET['email'])){
            include('../db.php');

            $email = $_GET['email'];
            $search = mysqli_query($con,"SELECT * FROM users WHERE email='$email' LIMIT 1")
            or die(mysqli_error($con));

            if($search){
                while($data = mysqli_fetch_assoc($search)){
                    $respose['code'] = 1;
                    $respose['message'] = "Dapat data bro.";
                    $respose['name'] = $data['name'];
                    $respose['email'] = $data['email'];

                    if($data['isScanned']==0){
                        $isScanned = "Unchecked";
                    }else{
                        $isScanned = "Checked in";
                    }
                    $respose['isScanned'] = $isScanned;
                    $respose['seat'] = $data['seat'];

                    if($data['currentBook']!="0"){
                        $crnBook = $data['currentBook'];
                        $setBook = mysqli_query($con,"SELECT title FROM books WHERE id = '$crnBook'")
                        or die(mysqli_error($con));

                        while($dataBook = mysqli_fetch_assoc($setBook)){
                            $respose['currentBook'] = $dataBook['title'];
                        }
                    }else{
                        $respose['currentBook'] = $data['currentBook'];
                    }
                    $respose['image'] = $data['image'];
                }
            }
        }else{
            $respose['code'] = 0;
            $respose['message'] = "Illegal moving";
        }
    }
echo json_encode($respose);
?>