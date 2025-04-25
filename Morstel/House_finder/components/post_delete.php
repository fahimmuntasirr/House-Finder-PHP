<?php

    include 'conn.php';

    session_start();

    $id = $_GET['id'];

    $stmt = $conn->prepare('select user_id from post where id = ?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if($row['user_id']==$_SESSION['user_id']){
        $stmt = $conn->prepare('delete from post_image where post_id = ?');
        $stmt->bind_param('i',$id);
        $stmt->execute();

        $stmt = $conn->prepare('delete from post where id = ?');
        $stmt->bind_param('i',$id);
        $stmt->execute();

        header('Location: ../profile.php');
    }else{
        header('Location: ../index.php');
    }

?>