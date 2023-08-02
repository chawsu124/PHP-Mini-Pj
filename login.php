<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic Login</title>
    <link rel="stylesheet" href="sources/css/bootstrap.min.css">
</head>
<body>
    <?php
        require_once "dbconnect.php";
        $errMsg = '';

        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = mysqli_query($db,$query);

            if(mysqli_num_rows($result) > 0){
                // $username = "";
                // foreach($result as $value){
                //     $username = $value['name'];
                // }
                //$_SESSION['name'] = $username;

                // or
                // $userArr = mysqli_fetch_assoc($result);
                // $_SESSION['name'] = $userArr['name'];

                // or sent the whole array
                $userArr = mysqli_fetch_assoc($result);
                $_SESSION['userArr'] = $userArr;

                if($userArr['role'] == 'user'){
                    header("location: user.php");
                }else if($userArr['role'] == 'admin'){
                    header("location: admin.php");
                }
            }else{
                $errMsg = "Invalid email or password";
            }
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header bg-success">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title fw-bold text-white">Login Page</h3>
                            <a href="index.php" class="text-decoration-none fs-5 text-white"> < < Back</a> 
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Login Form</h3>
                                        </div>
                                        <form action="" method="post">
                                            <div class="card-body">
                                            <?php if($errMsg != ''): ?>
                                                <div class="alert alert-danger alert-dismissible fade show text-center m-3" role="alert">
                                                    <strong><?php echo $errMsg ?></strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div> 
                                            <?php endif ?>   
                                                <div class="form-group">
                                                    <label class="fw-semibold">Email :</label>
                                                    <input type="email" name="email" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-semibold">Passowrd :</label>
                                                    <input type="password" name="password" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="form-group mt-1 d-flex justify-content-between">
                                                    <button name="login" class="btn btn-primary">Login</button>
                                                    <span class="fw-semibold">
                                                        If you don't have account,
                                                        <a href="register.php" class="text-decoration-none">Register Here !</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>    
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script src="sources/js/popper.min.js"></script>
    <script src="sources/js/bootstrap.min.js"></script>
</body>
</html>
