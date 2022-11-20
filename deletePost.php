<?php
    session_start();
        // delete post
        require_once "connect.php";

        if(isset($_GET['deleteid'])){
            $deleteID = $_GET['deleteid'];

            $qry = "DELETE FROM posts WHERE id=$deleteID";
            $delete = mysqli_query($db,$qry);

            $_SESSION['successMsg'] = "A post delete successfully";
            header("location: index.php");
        }
    ?>
