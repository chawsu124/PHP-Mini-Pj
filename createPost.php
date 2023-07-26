<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic PHP CRUD</title>
    <link rel="stylesheet" href="sources/css/bootstrap.min.css">
</head>
<body class="bg-white">
    <?php
        require_once "connect.php";
        
        $titleErr = '';
        $descriptionErr = '';

        if(isset($_POST['create'])){
            $title = $_POST['title'];
            $description = $_POST['description'];

            if(empty($title)){
                $titleErr = "This title field is required.";
                
            }
            if(empty($description)){
                $descriptionErr = "This description field is required.";
                
            }

            if(!empty($title) && !empty($description)){
                $query = "INSERT INTO posts(title,description) VALUES('$title','$description')";

                $res = mysqli_query($db,$query);

                if(isset($res)){
                    $_SESSION['successMsg'] = "A post create successfully .";
                    echo "Insert successfully";
                    header("location: index.php");
                }else{
                    echo "Insert Fail";
                }
            }
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
                                <label for="title" class="fw-semibold fs-5">Post Title :</label>
                                <input type="text" name="title" placeholder="Enter Post Title"
                                    class="form-control <?php if($titleErr != ''): ?>is-invalid<?php endif ?>" required>
                                <span class="text-danger"><?php echo $titleErr ?></span>
                            </div>
                            <div class="form-group mt-2">
                                <label for="description" class="fw-semibold fs-5">Post Description :</label>
                                <textarea name="description" class="form-control <?php if($descriptionErr != ''): ?>is-invalid<?php endif ?>" placeholder="Enter description" required></textarea>
                                <span class="text-danger"><?php echo $descriptionErr ?></span>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <div class="form-group mt-2">
                                <button name="create" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>

    <script src="sources/js/popper.min.js"></script>
    <script src="sources/js/bootstrap.min.js"></script>

    <!-- <script src="sources/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
