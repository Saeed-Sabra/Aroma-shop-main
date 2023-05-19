<?php
include 'DBconnection.php';
echo $_POST['select'];
// echo $_FILES["file"]["name"];
if (
    !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) &&
    !empty($_FILES["file"]["name"]) && !empty($_POST['select'])
) {

    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $select = $_POST['select'];

    $var1 = rand(1111, 9999); // generate random number in $var1 variable
    $var2 = rand(1111, 9999); // generate random number in $var2 variable

    $var3 = $var1 . $var2; // concatenate $var1 and $var2 in $var3
    $var3 = md5($var3); // convert $var3 using md5 function and generate 32 characters hex number

    $fnm = $_FILES["file"]["name"]; // get the image name in $fnm variable
    $dst = "../img/" . $var3 . $fnm; // storing image path into the {all_images} folder with 32 characters hex number and file name
    $dst_db = "img/" . $var3 . $fnm; // storing image path into the database with 32 characters hex number and file name


    $fileType = pathinfo($dst_db, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    // -----------------------------------
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
    } else {
        if ($res->num_rows > 0) {
            echo "<div> Email is exist </div>";
            return;
        } else {
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $dst)) {
                    // Insert data to database
                    if ($select == 'user') {
                        // $sql = "INSERT INTO user (name, email, password, select, img) VALUES (?, ?, ?, ?, ?)";
                        $sql = 'INSERT INTO user(name, email, password,file) VALUES (?,?,?,?)';
                    } else if ($select == "admin") {
                        $sql = 'INSERT INTO admin(name, email, password,file) VALUES (?,?,?,?)';
                    }
                    // check sql syntax
                    $res = $conn->prepare($sql);
                    $res->bind_param('ssss', $username, $email, $password, $dst_db);
                    $res->execute();
                    if ($res->error) {
                        $myJSON = 'error';
                        echo $myJSON;
                        return 0;
                    } else {
                        header("Location:../registeration.html");
                        exit();
                    }

                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                    echo $statusMsg;
                    return;
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                echo $statusMsg;
                return;
            }

            if ($res->error) {
                $myJSON = 'error';
                echo $myJSON;
                return 0;
            } else {
                header("Location:../registeration.html");
                exit();
            }
        }
    }
} else {
    echo "Enter All Information";
}