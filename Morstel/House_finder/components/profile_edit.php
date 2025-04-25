<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];
    $check = true;

    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $imageName = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $imageName;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageName)
    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {            
            include 'conn.php';
 
            $stmt = $conn->prepare("UPDATE user set pimage_name=?,pimage_loc=?,fname=?,lname=?,email=?,address=?,phone=?,last_edited_at=now() where id = ?");
            $stmt->bind_param("sssssssi", $imageName, $target_file, $fname, $lname, $email, $address, $phone, $id);
            if ($stmt->execute()) {                
                header("Location: ../profile.php");
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        } else {            
            include 'conn.php';

            $stmt = $conn->prepare("UPDATE user set fname=?,lname=?,email=?,address=?,phone=?,last_edited_at=now() where id = ?");
            $stmt->bind_param("sssssi", $fname, $lname, $email, $address, $phone, $id);
            if ($stmt->execute()) {
                header("Location: ../profile.php");
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "File is not an image.";
    }
}
