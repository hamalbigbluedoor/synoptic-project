<?php include "./includes/db.php" ?>

<?php 
	$blogNewCount = $_POST['blogNewCount'];

	// Load in 2 more comments
	$query = "SELECT * FROM blogs LIMIT $blogNewCount";
	$select_one_blog = mysqli_query($connection, $query);
	// Check if data exists
	if (mysqli_num_rows($select_one_blog) > 0) {
		while($row = mysqli_fetch_assoc($select_one_blog)){
			$image = $row['blog_image'];
			echo "<p>";
			echo $row['blog_title'];
			echo "<br>";
			echo $row['blog_date'];
			echo "<br>";
			echo $row['blog_content'];
			echo "<br>";
			echo "</p>";
			?>
      <img class="blog-image" src="uploads/<?php echo $image; ?>" alt="image">
		<?php
		}
	} else {
		echo "There are no Blogs!";
	}
?>
