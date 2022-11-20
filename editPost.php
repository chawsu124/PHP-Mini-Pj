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
<body class="bg-white">
    <?php
        require_once "connect.php";

        // show this id data
        if(isset($_GET['id'])){
            $update_id = $_GET['id'];
        }

        $sql = "SELECT * FROM posts WHERE id = $update_id";
        $res = mysqli_query($db,$sql);

        while($row = mysqli_fetch_assoc($res)){
            $title = $row['title'];
            $des = $row['description'];
        }

    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title fw-bold">Posts List</h3>
                            <a href="index.php" class="btn btn-secondary"> << Back </a> 
                        </div> 
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title" class="fs-5 fw-semibold">Post Title :</label>
                                <input type="text" name="title" placeholder="Enter Post Title"
                                    value="<?php echo $title ?>"
                                     class="form-control" required>
                                
                            </div>
                            <div class="form-group mt-2">
                                <label for="description" class="fs-5 fw-semibold">Post Description :</label>
                                <textarea type="text" rows="5" name="description"  placeholder="Enter Post description"
                                    class="form-control" required>
                                    <?php echo $des ?>    
                                </textarea>
                                
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <div class="form-group mt-2">
                                <button name="update" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>

    <?php
        // Update button
         require_once "connect.php";

        if(isset($_POST['update'])){
            echo "Hello";
            $titleUpdate = $_POST['title'];
            $desUpdate = $_POST['description'];

            $sql = "UPDATE posts SET title='$titleUpdate', description='$desUpdate'
            WHERE id = $update_id";

            $edit = mysqli_query($db,$sql);
            $_SESSION['successMsg'] = "A post update successfully";
            header("location: index.php");
          
        }
    ?>

    <script src="sources/js/popper.min.js"></script>
    <script src="sources/js/bootstrap.min.js"></script>

    <!-- <script src="sources/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>