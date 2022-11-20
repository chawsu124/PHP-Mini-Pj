<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic Login by Sr.YeMyintSoe</title>
    <link rel="stylesheet" href="sources/css/bootstrap.min.css">
</head>
<body>
    <?php
        require_once "dbconnect.php";
        $message = '';
        $nameErr = '';
        $emailErr = '';
        $addressErr = '';
        $pwErr = '';
        $cpwErr = '';

        if(isset($_POST['register'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if(empty($name)){
                $nameErr = "The name field is required";
            }
            if(empty($email)){
                $emailErr = "The email field is required";
            }
            if(empty($address)){
                $addressErr = "The address field is required";
            }
            if(empty($password)){
                $pwErr = "The password field is required";
            }
            if(empty($cpassword)){
                $cpwErr = "The confirm password field is required";
            }
            if($cpassword != $password){
                $cpwErr = "The confirm password is does not match with password.";
            }

            if(!empty($name) && !empty($email) && !empty($address) && !empty($password)
                && !empty($cpassword) && $cpassword == $password){

                //$encryptPw = md5($password);// if you want to encrypt your password
                $qry = "INSERT INTO users(name,email,address,password)
                VALUES('$name','$email','$address','$password')";

                $res = mysqli_query($db,$qry);

                if($res == true){
                    // echo "<script>alert('Register Successfully ! ')</script>";
                    header("location: index.php");
                }
            }
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header bg-success">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title fw-bold text-white">Home Page</h3>
                            <a href="index.php" class="text-decoration-none fs-5 text-white"> < < Back</a> 
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Registration Form</h3>
                                    </div>
                                    <form action="" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="fw-semibold">Name :</label>
                                                <input type="text" name="name" class="form-control" required>
                                                <span class="text-danger"><?php echo $nameErr ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="fw-semibold">Email :</label>
                                                <input type="text" name="email" class="form-control" required>
                                                <span class="text-danger"><?php echo $emailErr ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="fw-semibold">Address :</label>
                                                <textarea name="address" class="form-control" placeholder="Enter address" required></textarea>
                                                <span class="text-danger"><?php echo $addressErr ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="fw-semibold">Password :</label>
                                                <input type="password" name="password" class="form-control" required>
                                                <span class="text-danger"><?php echo $pwErr ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="fw-semibold">Confirm Password :</label>
                                                <input type="password" name="cpassword" class="form-control" required>
                                                <span class="text-danger"><?php echo $cpwErr ?></span>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group mt-1 d-flex justify-content-between">
                                                <button name="register" class="btn btn-info">Register</button>
                                                <span class="fw-semibold">
                                                    If you already had account,
                                                    <a href="login.php" class="text-decoration-none">Login Here !</a>
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