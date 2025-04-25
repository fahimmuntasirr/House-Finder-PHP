<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    include 'conn.php';

    $title = $_POST['title'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];
    $stat=0;

    $target_dir = "upload_post/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $fileInputs = ['image1', 'image2', 'image3', 'image4'];

    $stmt2 = $conn->prepare('insert into post (title,description,address,phone,user_id) values(?,?,?,?,?)');
    $stmt2->bind_param('ssssi',$title,$description,$address,$phone,$id);
    $stmt2->execute();
    $stmt2->close();

    $result = $conn->query("select max(id) as id from post");
    $row = $result->fetch_assoc();
    foreach ($fileInputs as $inputName) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
            $imageName = basename($_FILES[$inputName]["name"]);
            $target_file = $target_dir . $imageName;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES[$inputName]["tmp_name"]);

            if ($check !== false) {
                if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $target_file)) {                    
                    $stmt = $conn->prepare("INSERT INTO post_image (image, image_loc, post_id) VALUES (?, ?, ?)");
                    $stmt->bind_param("ssi", $imageName, $target_file, $row['id']);
                    if ($stmt->execute()) {
                        echo "The file " . htmlspecialchars($imageName) . " has been uploaded.<br>";
                        $stat = 1;
                    } else {
                        echo "Error: " . $stmt->error . "<br>";
                        $stat = 0;
                    }
                    $stmt->close();
                } else {
                    echo "Sorry, there was an error uploading your file " . htmlspecialchars($imageName) . ".<br>";
                }
            } else {
                echo "File " . htmlspecialchars($imageName) . " is not an image.<br>";
            }
        }
    }

    if($stat) header("Location: ../index.php");

    $conn->close();
}
?>
