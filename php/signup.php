<?php
include 'DBconnection.php';

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_FILES["file"]["name"])) {

    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    
    // $targetDir = "../img/";
    // $fileName = $_FILES["file"]["name"];
    
    $var1 = rand(1111,9999);  // generate random number in $var1 variable
    $var2 = rand(1111,9999);  // generate random number in $var2 variable

    $var3 = $var1.$var2;  // concatenate $var1 and $var2 in $var3
    $var3 = md5($var3);   // convert $var3 using md5 function and generate 32 characters hex number

    $fnm = $_FILES["file"]["name"];    // get the image name in $fnm variable
    $dst = "../img/".$var3.$fnm;  // storing image path into the {all_images} folder with 32 characters hex number and file name
    $dst_db = "img/".$var3.$fnm; // storing image path into the database with 32 characters hex number and file name

    // $targetFilePath1 = $targetDir . $var3 . $fileName;

    // $targetFilePath = "img/" . $var3 . $fileName;
    
    $fileType = pathinfo($dst_db,PATHINFO_EXTENSION);
    $allowTypes = array('jpg','png','jpeg','gif');

    // -----------------------------------
    // $sql2 = 'SELECT id FROM admin WHERE email = ? ';
    $sql = 'SELECT id FROM user WHERE email = ?';
    $res = $conn->prepare($sql);
    $res->bind_param('s', $email);
    $res->execute();
    $res->bind_result($id);
    $res->store_result();
    // ------------
    // $res1 = $conn->prepare($sql2);
    // $res1->bind_param('s', $email);
    // $res1->execute();
    // $res1->bind_result($id);
    // $res1->store_result();
    // if ($res1->num_rows > 0) {
    //     echo "<div>Email is exist</div>";
    //     return;
    // }
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
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $dst)){
                    $sql = 'INSERT INTO user(name, email, password,file) VALUES (?,?,?,?)';
                    // check sql syntax
                    $res = $conn->prepare($sql);
                    $res->bind_param('ssss', $username, $email,$password,$dst_db);
                    $res->execute();
                    if ($res->error) {
                        $myJSON = 'error';
                        echo $myJSON;
                        return 0;
                    } 
                    // else {
                    //     header("Location:../login.html");
                    //     exit();
                    // }
                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                     echo $statusMsg;
                     return;
                }
            }else{
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                echo $statusMsg;
                return;
            }
            
            if ($res->error) {
                $myJSON = 'error';
                echo $myJSON;
                return 0;
            } 
            // else {
            //     header("Location:../login.html");
            //     exit();
            // }
        }
    }
}
else {
    echo "Enter All Information";
}





// <?php
    // include "DBconnection.php";
    
    // if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_FILES["file"]["name"])) {
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     $password = md5($_POST['password']);
    //     $file = $_FILES["file"]["name"];

    //     $sql = "INSERT INTO user (name, email, password, file) VALUES ('$name', '$email', '$password', '$file')";
    //     $result = mysqli_query($conn, $sql);
        
    //     $var1 = rand(1111,9999);  // generate random number in $var1 variable
    //     $var2 = rand(1111,9999);  // generate random number in $var2 variable

    //     $var3 = $var1.$var2;  // concatenate $var1 and $var2 in $var3
    //     $var3 = md5($var3);   // convert $var3 using md5 function and generate 32 characters hex number

    //     $fnm = $_FILES["image"]["name"];    // get the image name in $fnm variable
    //     $dst = "../itemsImages/".$var3.$fnm;  // storing image path into the {all_images} folder with 32 characters hex number and file name
    //     $dst_db = "itemsImages/".$var3.$fnm; // storing image path into the database with 32 characters hex number and file name


    //     move_uploaded_file($_FILES["image"]["tmp_name"],$dst);

    //     $sql1 = "UPDATE user SET file = '$dst_db' WHERE email = $email";

    //     $result1 = mysqli_query($conn, $sql1);

    //     if ($result1 && $result) {
    //         header("Location: login.php");
    //     }


    // } 

    