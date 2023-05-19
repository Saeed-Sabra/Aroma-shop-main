<?php
include 'DBconnection.php';



if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql2 = 'SELECT id FROM admin WHERE email = ? ';
    $sql = 'SELECT id FROM user WHERE email = ?';
    $res = $conn->prepare($sql);
    $res->bind_param('s', $email);
    $res->execute();
    $res->bind_result($id);
    $res->store_result();
    // ------------
    $res1 = $conn->prepare($sql2);
    $res1->bind_param('s', $email);
    $res1->execute();
    $res1->bind_result($id);
    $res1->store_result();
    if ($res1->num_rows > 0) {
        echo "<div>Email is exist</div>";
        return;
    }
    if ($res->error) {
        $myJSON = 'error';
        echo $myJSON;
        return 0;
        // fetch(); لنصل الداتا بالاري
        // num_rows لفحص اذا كان يوجد داتا بالاري
    } else {
        if ($res->num_rows > 0) {
            echo "<div> Email is exist </div>";
            return;
        } else {
            $sql = 'INSERT INTO admin (name, email, password) VALUES (?,?,?)';
            // check sql syntax
            $i = 0;
            $i++;
            $res = $conn->prepare($sql);
            $res->bind_param('sss', $username, $email, $password);
            $res->execute();

            if ($res->error) {
                $myJSON = 'error';
                echo $myJSON;
                return 0;
            } else {
                header("Location:admin.php");
                exit();
            }
        }
    }
} else {
    echo "Enter All Information";
}