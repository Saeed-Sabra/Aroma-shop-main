<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Admin Page</title>
    <link rel="stylesheet" href="../assests/css/index_admin.css">
    <link rel="stylesheet" href="../assests/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assests/css/all.min.css">
    <link rel="stylesheet" href="../assests/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assests/css/bootstrap.min.css.map">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="card bg-light mb-3">
    <header>
        <div class="container">
            <div class="header_content">
                <a class="brand" href="index.html">Shopping Cart</a>
                <nav>
                    <ul id="links">
                        <li><a href="../login.html">Sign In</a></li>
                        <li><a href="../register.html">Sign Up</a></li>
                    </ul>
                    <ul id="user_info">
                        <li><a href="#" id="user"></a></li>
                        <li><a href="#" id="logOut">logOut</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- 
    <section class="Home">
        <div class="contaner">
            <div class="products">
                <div class="product_item">
                    <img class="product_item_image" src="../img/c-d-x-PDX_a_82obo-unsplash.jpg" alt="image">
                    <div class="product_item_describtion">
                        <h3>Headphone Item</h3>
                        <p>Hd Yellow Wallpapers</p>
                        <span>size:large</span>
                    </div>
                    <div class="product_item_action">
                        <button class="add_to_cart">Add To Cart</button>
                        <i><i class="fas fa-heart"></i></i>
                    </div>
                </div>
                <div class="product_item">
                    <img class="product_item_image" src="../img/eniko-kis-KsLPTsYaqIQ-unsplash.jpg" alt="image">
                    <div class="product_item_describtion">
                        <h3>Camera Item</h3>
                        <p>NIKON CORPORATION, NIKON D3200</p>
                        <span>size:large</span>
                    </div>
                    <div class="product_item_action">
                        <button class="add_to_cart">Add To Cart</button>
                        <i><i class="fas fa-heart"></i></i>
                    </div>
                </div>
                <div class="product_item">
                    <img class="product_item_image" src="../img/rachit-tank-2cFZ_FB08UM-unsplash.jpg" alt="image">
                    <div class="product_item_describtion">
                        <h3>Watch Item</h3>
                        <p>Hd 3d Wallpapers</p>
                        <span>size:large</span>
                    </div>
                    <div class="product_item_action">
                        <button class="add_to_cart">Add To Cart</button>
                        <i><i class="fas fa-heart"></i></i>
                    </div>
                </div>
                <div class="product_item">
                    <img class="product_item_image" src="../img/giorgio-trovato-K62u25Jk6vo-unsplash.jpg" alt="image">
                    <div class="product_item_describtion">
                        <h3>Glasses Item</h3>
                        <p>Canon, EOS 5D Mark III</p>
                        <span>size:large</span>
                    </div>
                    <div class="product_item_action">
                        <button class="add_to_cart">Add To Cart</button>
                        <i><i class="fas fa-heart"></i></i>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <br>
    <h2 class="text-uppercase font-weight-bold p-3 mb-2 bg-warning text-dark"> User information</h2>
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
                    echo '</tr>';
                }
                echo '</table>';
            }
        }
        ?>
    </table>
    <hr>
    <form action="signup.php" method="post">
        <h2 class="text-uppercase font-weight-bold p-3 mb-2 bg-warning text-dark">Register User</h2>
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
        <div class="mb-3">
            <label for="file" class="form-label">Image</label>
            <input type="file" name="file" class="form-control " id="file">
            <!-- <input type="file" name="file" id="file"> -->
        </div>
        <select name="select" id="">
            <option value="user" selected>User</option>
        </select>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr>
    <form action="create_admin.php" method="post">
        <h2 class="text-uppercase font-weight-bold p-3 mb-2 bg-warning text-dark">Register Admin</h2>
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
    <script src="../javaScript/all.min.js"></script>
    <script src="../javaScript/bootstrap.bundle.min.js"></script>
    <script src="../javaScript/bootstrap.bundle.min.js.map"></script>
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
            document.getElementById('tr-' + id).remove();
        }
    </script>
</body>

</html>