<?php
    include("inc/config.php");
    include("inc/header.php");
    authenticate();
?>   
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Post </title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function validate() {
                var f1=document.forms['edit']['title'].value;
                var f2=document.forms['edit']['content'].value;
                if(f1==null || f1=="" || f2==null || f2=="") {
                    alert("Both fields are necessary. Try again.");
                    return false;
                }
                else {
                    return true;
                }
            }
        </script>
    </head>
    <body>
    <div id="wrapper">
        <ul id="nav">
            <li><a href="dashboard.php">Back</a></li>
        </ul>
        <?php
            
            if(isset($_GET['id'])){
                if(isset($_POST['update'])) {
                    $id     = mysqli_real_escape_string($con,$_GET['id']);
                    $title      = mysqli_real_escape_string($con,$_POST['title']);
                    $content= mysqli_real_escape_string($con,$_POST['content']);
                    if(($title!=="") && ($content!=="")){
                        $time   = time();
                        $sql    = "UPDATE post SET title='$title', content='$content', timestamp=$time WHERE id=$id";
                        $sqlID  = mysqli_query($con,$sql);
                        if(mysqli_error($con)==="") {
                            echo "<script>location.href='dashboard.php?action=update';</script>";
                        } else {
                            echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
                        }
                    }
                }
                else {
                    $id     = mysqli_real_escape_string($con,$_GET['id']);
                    $query  = "SELECT title,content FROM post WHERE id='$id'";
                    $queryID= mysqli_query($con,$query);
                    $row    = mysqli_fetch_array($queryID);
                    if(mysqli_num_rows($queryID)===1) {
                    
                    ?>
                        <div id="box">
                        <form action="edit_post.php?id=<?php echo $id; ?>" method="post" name="edit" onsubmit="return validate();">
                            <h2>Edit Post</h2>
                            <br><label for="title">Title:</label> <input type="text" name="title" id="title" value="<?php echo $row['title']; ?>">
                            <br><label for="content">Content:</label> <textarea name="content" id="content"><?php echo $row['content']; ?></textarea>
                            <input name="update" value="true" type="hidden">
                            <button>Update</button>
                        </form>
                        </div>
                    <?php
                        } else {
                            echo "<div class='error'>The post cannot be edited</div>"; 
                            }// end else print error msg
                    } // end else print form
                }
        ?>
    
    </div>
    </body>
</html>