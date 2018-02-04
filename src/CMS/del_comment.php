<?php
    include("inc/config.php");
    include("inc/header.php");
    authenticate();
    
    if(isset($_GET['id'])){
        $id     = mysqli_real_escape_string($con,$_GET['id']);
        $query  ="DELETE FROM comment WHERE id=$id";
        $queryID= mysqli_query($con,$query);
        if($queryID){
            echo "<script>location.href='mod_comments.php?action=delete';</script>";
        }
        else {
            echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
        }
    }
?>