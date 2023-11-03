<?php
$servername="localhost";
$username="root";
$password="";
$dbname="customer_management";
$conn =mysqli_connect($servername,$username,$password,$dbname);
if ($_SERVER['REQUEST_METHOD']=="POST"){
    
    $customerName=$_POST['customerName'];
    $address=$_POST['address'];
    $notes=$_POST['notes'];
    $email=$_POST['email'];
    $isdCode=$_POST['isdCode'];
    $mobileNumber=$_POST['mobileNumber'];
    $sql="INSERT INTO `customers` (`customerName`, `address`, `notes`, `email`, `isdCode`, `mobileNumber`) VALUES ('$customerName', '$address', '$notes', '$email', '$isdCode', '$mobileNumber')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "success";
    }
    else{
        echo "failed";
    }
}
$conn->close();
?>