<?php

include 'conn.php';

$stmt = $conn->prepare('insert into report (post_id) values (?)');
$stmt->bind_param('i',$_GET['id']);
$stmt->execute();

$id = urldecode($_GET['id']);
header("Location: ../view.php?id=$id");
exit();