<?php
session_start();
include 'conn.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id,password,fname FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id,$hashed_password,$fname);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        echo "success";
        $_SESSION['user_id'] = $id; 
        $_SESSION['user_email'] = $email; 
        $_SESSION['logged_in'] = true;
        $_SESSION['fname'] = $fname;
    } else {
        echo "password error";
    }
} else {
    echo "email and password error";
}

$stmt->close();


$conn->close();

