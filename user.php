<?php 
    session_start();
    require_once "dbconnect.php";

    if(!isset($_SESSION['userArr'])){// if session have
        header("location: index.php");
    }else{ // if don't have session
        if($_SESSION['userArr']['role'] != 'user'){
            header("location: admin.php");
        }
    }
    // sweetalert.js.org
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic Login by Sr.YeMyintSoe</title>
    <link rel="stylesheet" href="sources/css/bootstrap.min.css">
     <!-- use PHP sweetAlert -->
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
    <?php
        //Read Authenicate User info from database]
        $authUserID = $_SESSION['userArr']['id'];

        $authQuery = "SELECT * FROM users WHERE id=$authUserID";
        $authRes = mysqli_query($db,$authQuery);

        $authUserArr = mysqli_fetch_assoc($authRes);//get the whole array of rows from users table where $_SESSION['userArr']


        // when you click Edit Your Info button in User Info Card
        $userUpdateStatus = false;

        if(isset($_GET['updateID'])){
            $userUpdateID = $_GET['updateID'];

            $userUpdateStatus = true;

            $selectQry = "SELECT * FROM users WHERE id = $userUpdateID";
            $selectR = mysqli_query($db,$selectQry);
            
            $update = mysqli_fetch_assoc($selectR);
        }

        // when you click Update button in User Edit Form
        if(isset($_POST['update'])){
            $upName = $_POST['name'];
            $upEmail = $_POST['email'];
            $upAddress = $_POST['address'];
            $upPassword = $_POST['password'];

            $updateQry = "UPDATE users SET name='$upName',email='$upEmail',address='$upAddress',
                password='$upPassword' WHERE id= $userUpdateID";
            $updateR = mysqli_query($db,$updateQry);

            if($updateR){
                $_SESSION['expireTime'] = time() + (0.1 * 60);// 1 second long
                // use PHP sweetAlert
                $_SESSION['successMsg'] = "<script>swal('Update Successfully!', 'You clicked the button!', 'success')</script>";
                header("location: user.php");
            }
        }
        // show sweetAlert
        if(time() < $_SESSION['expireTime']){
            echo $_SESSION['successMsg'];
        }else{
            unset($_SESSION['successMsg']);
            unset($_SESSION['expireTime']);
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header bg-success">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title fw-semibold text-white">User-dashboard</h3>
                            <form method="get" action="logout.php">
                                <button onclick="return confirm('Are you sure you want to logout?')" class="btn btn-danger btn-lg">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>User Info</h4>
                                        <div>
                                            Role : 
                                            <span class="badge text-bg-success badge-lg">
                                                <?php echo $authUserArr['role'] ?>
                                            </span>
                                        </div>
                                        <div>
                                            Name : <?php echo $authUserArr['name'] ?>
                                        </div>
                                        <div>
                                            Email : <?php echo $authUserArr['email'] ?>
                                        </div>
                                        <div>
                                            Address : <?php echo $authUserArr['address'] ?>
                                        </div>
                                        <div>
                                            <a href="user.php?updateID=<?php echo $authUserArr['id'] ?>" class="btn btn-success">Edit Your Info</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-md-6">
                                <?php if($userUpdateStatus){ ?>
                                    <div class="card">
                                        <h4 class="card-header">User Edit Form</h4>
                                        <form method="post" action="">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="fw-semibold">Name :</label>
                                                    <input type="text" name="name" value="<?php echo $update['name'] ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-semibold">Email :</label>
                                                    <input type="email" name="email" value="<?php echo $update['email'] ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-semibold">Address :</label>
                                                    <textarea name="address" class="form-control" required>
                                                        <?php echo $update['address'] ?>
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="fw-semibold">Password :</label>
                                                    <input type="password" name="password" value="<?php echo $update['password'] ?>" class="form-control" required>
                                                </div>
                                                
                                            </div>
                                            <div class="card-footer">
                                                <button name="update" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
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