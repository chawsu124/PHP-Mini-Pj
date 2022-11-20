<?php 
    session_start();
    require_once "dbconnect.php";

    if(!isset($_SESSION['userArr'])){// if session have
        header("location: index.php");
    }else{ // if don't have session
        if($_SESSION['userArr']['role'] != 'admin'){
            header("location: user.php");
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

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header bg-success">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title fw-semibold text-white">Admin-dashboard</h3>
                            <form method="get" action="logout.php">
                                <button onclick="return confirm('Are you sure you want to logout?')" class="btn btn-danger btn-lg">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                            //Read Authenicate Admin info from database
                            $authAdminID = $_SESSION['userArr']['id'];

                            $authQuery = "SELECT * FROM users WHERE id=$authAdminID";
                            $authRes = mysqli_query($db,$authQuery);

                            $authAdminArr = mysqli_fetch_assoc($authRes);//get the whole array of rows from users table where $_SESSION['userArr']

                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Admin Info</h4>
                                        <div>
                                            Role : 
                                            <span class="badge text-bg-success">
                                                <?php echo $authAdminArr['role'] ?>
                                            </span>
                                        </div>
                                        <div>
                                            Name : <?php echo $authAdminArr['name'] ?>
                                        </div>
                                        <div>
                                            Email : <?php echo $authAdminArr['email'] ?>
                                        </div>
                                        <div>
                                            Address : <?php echo $authAdminArr['address'] ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    // Click edit button from UserList Table
                                    $editStatus = false;
                                    if(isset($_GET['editID'])){
                                        $editStatus = true;
                                        $editID = $_GET['editID'];// Click id you want to edit

                                        $selectQry = "SELECT * FROM users WHERE id=$editID";
                                        $res = mysqli_query($db,$selectQry);

                                        $update = mysqli_fetch_assoc($res);// get the whole array of rows from users table where you click
                                    }

                                    // when you click Update button in User Edit Form
                                    if(isset($_POST['update'])){
                                        $updateName = $_POST['name'];
                                        $updateEmail = $_POST['email'];
                                        $updateAddress = $_POST['address'];
                                        $updatePw = $_POST['password'];
                                        $updateRole = $_POST['role'];

                                        $updateQry = "UPDATE users SET name='$updateName',email='$updateEmail',address='$updateAddress',
                                                    password='$updatePw',role='$updateRole' WHERE id= $editID";
                                        $updateRes = mysqli_query($db,$updateQry);

                                        if($updateRes){
                                            $_SESSION['expireTime'] = time() + (0.1 * 60);// 1 second long
                                            // use PHP sweetAlert
                                            $_SESSION['successMsg'] = "<script>swal('Update Successfully!', 'You clicked the button!', 'success')</script>";
                                            header("location: user.php");
                                        }
                                    }

                                    // Click Delete button from UserList Table
                                    if(isset($_GET['deleteID'])){
                                        $deleteID = $_GET['deleteID'];

                                        $deleteQry = "DELETE FROM users WHERE id= $deleteID";
                                        $deleteRes = mysqli_query($db,$deleteQry);

                                        if($deleteRes){
                                            echo "<script>alert('Update Successfully ! ')</script>";
                                        }
                                    }
                                ?>

                                <!-- if you click Edit button in User List table, show User Edit Form -->
                                <?php if($editStatus){ ?>
                                    <div class="card mt-3">
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
                                                <div class="form-group">
                                                    <label class="fw-semibold">Role :</label>
                                                    <select name="role" class="form-control">
                                                        <option value="admin" 
                                                            <?php if($update['role'] == 'admin'){ ?>selected<?php } ?>>
                                                            Admin
                                                        </option>
                                                        <option value="user"
                                                            <?php if($update['role'] == 'user'){ ?>selected<?php } ?>>
                                                            User
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button name="update" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                                
                            <div class="col-md-8">
                                <h4>User List</h4>
                                <table class="table table-bordered table-hover">
                                    <thead class="fs-5">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $qry = "SELECT * FROM users";
                                            $result = mysqli_query($db,$qry);

                                            while($row=mysqli_fetch_assoc($result)){
                                                $id = $row['id'];
                                                $name = $row['name'];
                                                $email = $row['email'];
                                                $address = $row['address'];
                                                $role = $row['role'];
                                            
                                                ?>
                                                <tr>
                                                    <td><?php echo $id ?></td>
                                                    <td><?php echo $name ?></td>
                                                    <td><?php echo $email ?></td>
                                                    <td><?php echo $address ?></td>
                                                    <td><?php echo $role ?></td>
                                                    <td>
                                                        <a href="admin.php?editID=<?php echo $id ?>" class="btn btn-primary btn-sm">Edit</a>
                                                        <a href="admin.php?deleteID=<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
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