<?php

include 'DBconnection.php';

if (!empty($_POST["email"]) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);


    $sql = "SELECT id FROM user WHERE email = ? AND password = ?";
    $res = $conn->prepare($sql);
    $res->bind_param('ss', $email, $password);
    $res->execute();
    $res->bind_result($id);
    $res->store_result();
    /************************************/
    $sql1 = "SELECT id FROM admin WHERE email = ? AND password = ?";
    $res1 = $conn->prepare($sql1);
    $res1->bind_param('ss', $email, $password);
    $res1->execute();
    $res1->bind_result($id);
    $res1->store_result();

    if ($res1->num_rows > 0) {
        while ($res1->fetch()) {
            header("Location:admin.php?id=" . $id);
            exit();
        }
    } else {
        if ($res->error) {
            $myJSON = 'error';
            echo $myJSON;
            return 0;

        } else {
            if ($res->num_rows > 0) {
                while ($res->fetch()) {
                    header("Location: ../index.html?id=" . $id);
                    exit();

                }
            } else {
                echo "<div> Account Not Found </div>";
                return;
            }
        }

    }
}