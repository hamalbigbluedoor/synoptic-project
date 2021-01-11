<?php include "./includes/header.php" ?>
<?php include "./includes/db.php" ?>
<?php include "./includes/navigation.php" ?>

<div id="blog">
  <div class="container">
    <div class="title">
      <h1>Blogs</h1>
    </div>

<?php 
  $query = "SELECT * FROM blogs LIMIT 2";
  $select_one_blog = mysqli_query($connection, $query);
  // Check if data exists
  if (mysqli_num_rows($select_one_blog) > 0) {
    while($row = mysqli_fetch_assoc($select_one_blog)) {
      $blog_id = $row['id'];
      $blog_title = $row['blog_title'];
      $blog_date = $row['blog_date'];
      $blog_content = substr($row['blog_content'], 0, 255) . " ...";
      $blog_image = $row['blog_image'];
      ?>

      <h3><?php echo $blog_title ?></h3>
      <p><span class="glyphicon glyphicon-time"></span> <?php echo $blog_date ?></p>
      <div>
        <img class="blog-image img-responsive" src="uploads/<?php echo $blog_image; ?>" alt="image">
      </div>
      <p><?php echo $blog_content ?></p>
      <a class="button" href="blog-post.php?blog_id=<?php echo $blog_id; ?>">Read More</a>
      <hr>
      <?php
    }
  } else {
    echo "There are no Blogs!";
  }
?>

  </div>
</div>
<button id="blog-button" class="main-buttons">Show More Blogs</button>

<?php include "./includes/footer.php" ?>
