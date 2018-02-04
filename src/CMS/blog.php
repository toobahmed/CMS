<?php
	include("inc/config.php");
	include("inc/header.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link href="style_blog.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
            function validate() {
                var f1=document.forms['comment']['author'].value;
                var f2=document.forms['comment']['comment'].value;
		var reEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,3}))$/;
                if(f1==null || f1=="" || f2==null || f2=="") {
                    alert("Both fields are necessary. Try again.");
                    return false;
                }
		else if(!(reEmail.test(f1))) {
			alert("Email ID is invalid");
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
	<div id="header">
		<div id="loginStrip">
		<?php
		if(isLoggedIn())
			echo "<a href='dashboard.php'>Dashboard</a>";
		else
			echo "<a href='login.php'>Login</a>";
		?>
		</div>
		<a href="blog.php">
			<h1>Scattered Thoughts</h1>
			<h2>Art, Poetry and Philosohy...</h2>
		</a>
		
	</div>
	<div id="content">
		<div id="main">
			
		</div>
		<?php
		if(isset($_GET['id'])){ //single post
			$id=$_GET['id'];
			$sql= "SELECT * FROM post WHERE id='$id'";
			$sqlID= mysqli_query($con,$sql);
			if(mysqli_num_rows($sqlID)==1){
				$row=mysqli_fetch_array($sqlID);
				?>
				<div class="post single_post">
					<div class="timestamp">
						<?php echo date('g:i:a, d M Y',$row['timestamp']); ?>
					</div>
					<h2>
						<?php echo $row['title']; ?>
					</h2>
					<div class='entry'>
						<?php echo nl2br($row['content']); ?>
					</div>
					<script>document.title = "<?php echo $row['title']; ?>"+" - "+document.title;</script>
					
				</div>
				<div id="comment_wrap">
					
					<div id="comments">
					
						<?php  //display comment if exists
							$sql= "SELECT * FROM comment WHERE post_id='$id'";
							$sqlID= mysqli_query($con,$sql);
							$nums = mysqli_num_rows($sqlID);
							if($nums!=0){
								echo "<h2 class='cmt_count'>".$nums." comment"._s($nums)." &mdash;</h2>";
								while($row=mysqli_fetch_array($sqlID)) {
								?>
									<div class="comment">
										
										<div class='cmt_author'>
											<?php echo $row['author']; ?>
										</div>
										<div class="cmt_time">
											<?php echo date('g:i:a, d M Y',$row['timestamp']); ?>
										</div>
										<div class='cmt_text'>
											<?php echo nl2br($row['comment']); ?>
										</div>
										
									</div>
								<?php
								}
							} else {
								echo "<h2 class='cmt_count'>No comments yet</h2>";
							}
						?>
					</div>
					<form action="blog.php?id=<?php echo $id; ?>" method="post" name="comment" onsubmit="return validate();">
						<div id="cmt_form">
							<input type="text" name="author" placeholder="email" id="author">
							<textarea name="comment" id="comment" placeholder="comment"></textarea>
							<input name="save" value="true" type="hidden">
							<button>Submit</button>
							<div class="clear"></div>
						</div>
					</form>
					<?php //save comment
						if(isset($_POST['save'])){
							$author     =	htmlspecialchars(mysqli_real_escape_string($con,$_POST['author']));
							$comment    =	htmlspecialchars(mysqli_real_escape_string($con,$_POST['comment']));
							if(($author!=="") && ($comment!=="")) {
								$time       =	time();
								$sql        = 	"INSERT INTO comment(post_id,author,comment,timestamp) VALUES($id,'$author','$comment',$time)";
								$sqlID      = 	mysqli_query($con,$sql);
								if($sqlID){
								    echo "<script>location.href='blog.php?id=$id';</script>";
								}
								else {
								    echo "<div class='error'>ERROR : ".mysqli_error($con)."</div>";
								}	
							}							 	
						}
						
					?>
				</div>
				<?php				
			}
			else {
				echo "<div class='error'>Post Not Found</div>";	
			}
		}
		else { //display all posts
			$sql= "SELECT * FROM post";
			$sqlID= mysqli_query($con,$sql);
			if(mysqli_num_rows($sqlID)!=0){
				while($row=mysqli_fetch_array($sqlID)) {
				?>
					<div class="post">
						<div class="timestamp">
							<?php echo date('d M Y',$row['timestamp']); ?>
						</div>
						<h2>
							<a href="blog.php?id=<?php echo $row['id']; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a>
						</h2>
						<div class='entry'>
							<?php echo nl2br($row['content']); ?>
						</div>
						
					</div>
				<?php
				}
			} else {
				echo "<div class='error'>No Posts Found</div>";
			}
		}
		?>
	</div>
</div>

</body>
</html>
