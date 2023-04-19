<?php include("connection/config.php"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Task Management system</title>
</head>

<body>

    <section class="p-5">
        <div class="container">
          <div class="card w-25 mx-auto shadow p-3">
            <div class="card-body">
            <div class="form">
                <h5 class="py-5">Task Management system</h5>

                <?php
                if (isset($_POST['submit'])) {
                    $username = $_POST['name'];
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);

                    // validation to input field
                    if ($username != "" && $email != "" && $password != "") {

                        $query = "SELECT * FROM users WHERE email='$email'";

                        // Execute the query
                        $result = mysqli_query($conn, $query);

                        // Check if the query returned any rows
                        if (mysqli_num_rows($result) > 0) {
                            // User with the same username already exists, display an error message
                            echo "<p>Email already taken.</p>";
                            header("Refresh:1");
                        } 
                        else {  
                            $query = "INSERT INTO users (name, email, password) 
                    VALUES ('$username','$email','$password')"; // variable

                            $result = mysqli_query($conn, $query); // connect to database
                            if ($result) {
                                echo " <span style='color:green' class='bg-success text-white px-5'>data is  submitted</span>";
                                header('Refresh: 0.34; url=manage-task.php');
                                // <meta http-equiv="refresh" content=" 0 ; url = manageuser.php" />

                            } else {
                                echo " <span style='color:red'>data is not submitted</span>";
                            }
                        }
                    } else {
                        echo "<span style='color:warning' class='bg-danger text-white px-5'>All Fields are required</span>";
                    }
                }
                ?>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="userHelp" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <a class="text-primary ps-5 text-decoration-none" href="index.php" role="button"> Login </a>
                </form>
            </div>
            </div>
          </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>