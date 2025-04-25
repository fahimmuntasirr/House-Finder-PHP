<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "morstel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['semail'];
$address = $_POST['address'];
$password = $_POST['spassword'];

$stmt2 = $conn->prepare("Select * from user where email = ?");
$stmt2->bind_param("s",$email);
$stmt2->execute();
$stmt2->store_result();
if($stmt2->num_rows>0 ){
    echo 'Email is already used';
    $conn->close();
}
else{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO user (fname,lname,email,address, password) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss",$fname,$lname,$email,$address,$hashed_password );
    
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo "<div style='color: red;'>Error: " . $stmt->error . "</div>";
    }
    
    $stmt->close();
    $conn->close();
}

