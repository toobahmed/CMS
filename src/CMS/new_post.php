<?php
    include("inc/config.php");
    include("inc/header.php");
    authenticate();
?>   
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Post</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function validate() {
                var title=document.forms['new']['title'].value;
                var content=document.forms['new']['content'].value;
                if(title==null || title=="" || content==null || content=="") {
                    alert("Both fields are necessary. Try again.");
                    return false;
                }
                else {
                    return true;
                }
            }
        </script>
    </head>
    <body><div id="wrapper">
        <ul id="nav">
            <li><a href="dashboard.php">Back</a></li>
        </ul>
        <?php
            if(isset($_POST['save'])){
                $title      =mysqli_real_escape_string($con,$_POST['title']);
                $content    =mysqli_real_escape_string($con,$_POST['content']);
                if(($title!=="") && ($content!=="")){
                    $time       =time();
                    $sql        = "INSERT INTO post(title,content,timestamp) VALUES('$title','$content',$time)";
                    $sqlID      = mysqli_query($con,$sql);
                    if($sqlID){
                        echo "<script>location.href='dashboard.php?action=new';</script>";
                    }
                    else {
                        echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
                    }   
                }                 
            }
            else{
                ?>
                <div id="box">
                <form name="new" action="new_post.php" method="post" onsubmit="return validate();">
                    <h2>New Post</h2>
                    <br><label for="title">Title:</label> <input type="text" name="title" id="title">
                    <br><label for="cotent">Content</label> <textarea name="content" id="content"></textarea>
                    <br><button name="save">Post</button>
                </form>
                </div>
            <?php
            }
        ?>
    </div>
    </body>
</html>
