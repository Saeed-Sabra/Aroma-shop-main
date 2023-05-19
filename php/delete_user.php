<?php
include 'DBconnection.php';

$id = $_POST['id'];

$sql = 'DELETE FROM user WHERE id = ?';
$res = $conn->prepare($sql);
$res->bind_param('i', $id);
$res->execute();

if ($res->error) {
    echo 'error';
    return 0;
} else {
    echo 'success';
}