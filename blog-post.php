<?php include "./includes/header.php" ?>
<?php include "./includes/db.php" ?>
<?php include "./includes/navigation.php" ?>

<div id="blog">
  <div class="container">

<?php
  if (isset($_GET['blog_id'])) {
    // We convert the key so we can check against it
    $get_blog_id = $_GET['blog_id'];
  }
    
  // We want the id column to equal the blog_id we are catching in the URL
  $query = "SELECT * FROM blogs WHERE id = $get_blog_id";
  $select_all_posts_query = mysqli_query($connection, $query);

  // This will pull in dynamic data from the database each time we create a new post
  while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
    $blog_title = $row['blog_title'];
    $blog_date = $row['blog_date'];
    $blog_content = $row['blog_content'];
    $blog_image = $row['blog_image'];
    ?>

      <h3><?php echo $blog_title ?></h3>
      <p><span class="glyphicon glyphicon-time"></span> <?php echo $blog_date ?></p>
      <hr>
      <div>
        <img class="blog-image img-responsive" src="uploads/<?php echo $blog_image; ?>" alt="image">
      </div>
      <hr>
      <p><?php echo $blog_content ?></p>
      </div>
    </div>
  <?php
  }
  ?>

<?php include "./includes/footer.php" ?>
