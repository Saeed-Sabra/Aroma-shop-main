<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Store | Admin Page</title>
    <link rel="stylesheet" href="../assests/css/index_admin.css">
    <link rel="stylesheet" href="../assests/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="card bg-light mb-3">
    <header>
        <div class="container">
            <div class="header_content">
                <nav>
                    <ul id="links">
                        <li><a href="../index.html" style="text-decoration: none;">Shopping Store</a></li>
                        <li><a href="../registeration.html" style="text-decoration: none;">Sign In/ Sign Up</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <br>
    <h2 class="text-uppercase font-weight-bold p-3 mb-2 bg-warning text-dark"> Users information</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">email</th>
                <th scope="col" colspan="3">name</th>
            </tr>
        </thead>
        <?php
        include 'DBconnection.php';
        $i = 0;

        $sql = 'SELECT * FROM user';
        $res = $conn->prepare($sql);
        $res->execute();
        $res->bind_result($id, $name, $email, $password, $file);
        $res->store_result();

        if ($res->error) {
            $myJSON = 'error';
            echo $myJSON;
            return 0;
        } else {
            if ($res->num_rows > 0) {

                while ($res->fetch()) {
                    echo "<tr id='tr-" . $id . "'>";
                    echo "<th scope='row'>$id</th>";
                    echo "<td>$email</td>";
                    echo "<td>$name</td>";
                    echo "<td><button id='$id' onclick='deleteUser(this.id)' class='btn btn-primary'>Delete</button></td>";
                    echo "<td><button id='$id' onclick='updateUser(this.id)'  class='btn btn-primary'>Update</button></td>";
                    echo "<td><button id='$id' onclick='changepass(this.id)'  class='btn btn-primary'>Change Password</button></td>";
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
        ?>
    </table>
    <hr>
    <form action="create_user.php" method="post">
        <h2 class="text-uppercase font-weight-bold p-3 mb-2 bg-warning text-dark">Add User</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input type="text" name="name" class="form-control userName" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control email" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control password" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr>
    <form action="create_admin.php" method="post">
        <h2 class="text-uppercase font-weight-bold p-3 mb-2 bg-warning text-dark">Add Admin</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Admin Name</label>
            <input type="text" name="name" class="form-control userName" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control email" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control password" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        function deleteUser(id) {
            $.ajax({
                type: "POST",

                url: "delete_user.php",
                data: {
                    id: id
                },
            });
            document.getElementById('tr-' + id).remove();
        }

        function updateUser(id) {
            $.ajax({
                type: "POST",

                url: "update_user.php",
                data: {
                    id: id
                },
            });
            document.getElementById('tr-' + id);
        }
        function changePass(id) {
            $.ajax({
                type: "POST",

                url: "changepass.php",
                data: {
                    id: id
                },
            });
            document.getElementById('tr-' + id);
        }
        //admin change user password?
    </script>
</body>

</html>