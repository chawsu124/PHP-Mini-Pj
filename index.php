<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic PHP CRUD by Sr.YeMyintSoe</title>
    <link rel="stylesheet" href="sources/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title fw-bold">Posts List</h3>
                            <a href="createPost.php" class="btn btn-primary">+Add Post</a> 
                        </div> 
                    </div>
                    <div class="card-body">
                        <!-- Show Alert Message -->
                        <?php if(isset($_SESSION['successMsg'])): ?>
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong><?php echo $_SESSION['successMsg'] ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <?php 
                                    //echo $_SESSION['successMsg'];// when successfully create post
                                    unset($_SESSION['successMsg']);// when refresh browser
                                ?>
                                
                            </div>
                        <?php endif ?>    
                        <table class="table table-bordered">
                            <thead class="fs-5">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once "connect.php";

                                    $qry = "SELECT * FROM posts";
                                    $result = mysqli_query($db,$qry);

                                    while($row=mysqli_fetch_assoc($result)){
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        $description = $row['description'];
                                   
                                        ?>
                                        <tr>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $title ?></td>
                                            <td><?php echo $description ?></td>
                                            <td>
                                                <a href="editPost.php?id=<?php echo $id ?>">Edit</a> |
                                                <a href="deletePost.php?deleteid=<?php echo $id ?>"
                                                 onclick="return confirm('Are you sure you want to delete?')">Delete
                                                </a>
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

    <?php
        // delete post
        // require_once "connect.php";

        // if(isset($_GET['deleteid'])){
        //     $deleteID = $_GET['deleteid'];

        //     $qry = "DELETE FROM posts WHERE id=$deleteID";
        //     $delete = mysqli_query($db,$qry);

        //     $_SESSION['successMsg'] = "A post delete successfully";
        //     header("location: index.php");
        // }
    ?>

    <script src="sources/js/popper.min.js"></script>
    <script src="sources/js/bootstrap.min.js"></script>

    <!-- <script src="sources/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>