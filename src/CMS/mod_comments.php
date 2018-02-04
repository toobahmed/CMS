<?php
    include("inc/config.php");
    include("inc/header.php");
    authenticate();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Moderate Comments</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="wrapper">
		<ul id="nav">
			<li><a href='blog.php'>View Blog</a></li>
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href='login.php?logout'>Logout</a></li>
		</ul>
		<h2 class="text-center">Moderate Comments</h2>
		
		<div class="clear"></div>
		<?php
			if(isset($_GET['action'])){
				if($_GET['action']==="delete"){
					echo "<div class='success'>Comment successfully deteted</div>";
				}
			}
			$sql= "SELECT *,comment.id AS cid,post.id AS pid FROM comment,post WHERE post.id=comment.post_id";
			$sqlID= mysqli_query($con,$sql);
			if(mysqli_num_rows($sqlID)!=0){
				
			    echo "
				<table border='0' class='tbl' cellspacing='0' cellpadding='0'>
				    <tr>
					<th>Post</th>
					<th>Email</th>
					<th>Comment</th>
					
					<th>Time</th>
					<th>Action</th>
				    </tr>";
				while($row=mysqli_fetch_array($sqlID)){
					$pid=$row['pid'];
					$cid=$row['cid'];
				    echo "
					<tr>
						<td><a href='blog.php?id=".$pid."' target='_blank'>".$row['title']."</a></td>
						<td>".$row['author']."</td>
						<td>".substr($row['comment'],-30)."</td>
						
						<td class='text-center'>".@date('Y-m-d H:i:s',$row['timestamp'])."</td>
						<td class='text-center'><a href='del_comment.php?id=$cid'>Delete</a></td>
					</tr>";
				    }
				echo "</table>";
			    }
			else{
			    echo "<div class='error'>No Comments Found</div>";
			}
		?>
		
	</div>
</body>
</html>
