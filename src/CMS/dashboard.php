<?php
    include("inc/config.php");
    include("inc/header.php");
    authenticate();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div id="wrapper">
        <ul id="nav">
            <li><a href='blog.php'>View Blog</a></li>
            <li><a href='new_post.php'>New</a></li>
            <li><a href='mod_comments.php'>Moderate Comments</a></li>
            <li><a href='login.php?logout'>Logout</a></li>
        </ul>
    <h2 class="text-center">Manage Posts</h2>
    <div class="clear"></div>    
    <?php
    
    if(isset($_GET['action'])) {
        if($_GET['action']==="delete"){
            echo "<div class='success'>Post successfully deteted</div>";
            
        }
        else if($_GET['action']==="new"){
            echo "<div class='success'>Post successfully saved</div>";
        }
        else if($_GET['action']==="update"){
            echo "<div class='success'>Post successfully updated</div>";
        }
    }
    echo "<br>";
    
    $sql= "SELECT * FROM post";
    $sqlID= mysqli_query($con,$sql);
    if(mysqli_num_rows($sqlID)!=0){
        echo "
            <table border='0' class='tbl' cellspacing='0' cellpadding='0'>
                <tr>
                    <th>Title</th>
                    <th>Post</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>";
            while($row=mysqli_fetch_array($sqlID)){
            $id=$row['id'];
                echo "
                    <tr>
                        <td><a href='blog.php?id=".$id."' target='_blank'>".$row['title']."</a></td>
                        <td>".substr($row['content'],-30)."</td>
                        <td class='text-center'>".@date('Y-m-d H:i:s',$row['timestamp'])."</td>
                        <td class='text-center'><a href='del_post.php?id=".$row['id']."'>Delete</a> / <a href='edit_post.php?id=".$row['id']."'>Edit</a></td>
                    </tr>";
                }
            echo "</table>";
        }
    else{
        echo "<div class='error'>No Posts Found</div>";
    }
    ?>
    </div>
    </body>
</html>

