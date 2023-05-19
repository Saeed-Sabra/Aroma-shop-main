<?php

include 'DBconnection.php';


$name = "";
$number = "";
$email = "";
$pass = "";

$name_err = $number_err = $email_err = $pass_err = "";

if (isset($_POST["email"]) && !empty($_POST["email"])) {
    $email = $_POST["email"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    $input_number = trim($_POST["number"]);
    if (empty($input_number)) {
        $number_err = "Please enter a number.";
    } else {
        $number = $input_number;
    }

    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter an email.";

    } else {
        $email = $input_email;
    }

    $input_pass = trim($_POST["password"]);
    if (empty($input_pass)) {
        $pass_err = "Please enter a password.";
    } else {
        $pass = $input_pass;
    }



    if (empty($name_err) && empty($number_err) && empty($email_err) && empty($pass_err)) {
        $sql = "UPDATE admin_form SET name=?, number=?, email=? , password=?  WHERE email=?";



        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_number, $param_email, $param_pass, $param_email);
            $param_name = $name;
            $param_number = $number;
            $param_email = $email;
            $param_pass = $pass;

            if (mysqli_stmt_execute($stmt)) {
                header("location: admin_page.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
} else {
    if (isset($_GET["email"]) && !empty(trim($_GET["email"]))) {
        $email = trim($_GET["email"]);

        $sql = "SELECT * FROM admin_form WHERE email = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $name = $row["name"];
                    $number = $row["number"];
                    $email = $row["email"];
                    $pass = $row["password"];
                } else {

                    header("location: error.php");
                    exit();
                }


            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);

        mysqli_close($conn);
    } else {
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name"
                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $name; ?>">
                            <span class="invalid-feedback">
                                <?php echo $name_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Number</label>
                            <textarea name="number"
                                class="form-control <?php echo (!empty($number_err)) ? 'is-invalid' : ''; ?>"><?php echo $number; ?></textarea>
                            <span class="invalid-feedback">
                                <?php echo $number_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <textarea name="email"
                                class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"><?php echo $email; ?></textarea>
                            <span class="invalid-feedback">
                                <?php echo $email_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $pass; ?>">
                            <span class="invalid-feedback">
                                <?php echo $pass_err; ?>
                            </span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="update">
                        <a href="admin_page.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>