<?php include "./includes/header.php" ?>
<?php include "./includes/db.php" ?>
<?php include "./includes/navigation.php" ?>

<div id="blog">
  <?php 
    $query = "SELECT * FROM blogs LIMIT 1";
    $select_one_blog = mysqli_query($connection, $query);
    // Check if data exists
    if (mysqli_num_rows($select_one_blog) > 0) {
      while($row = mysqli_fetch_assoc($select_one_blog)) {
        echo "<br>";
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
        <div>
          <img class="blog-image" src="uploads/<?php echo $image; ?>" alt="image">
        </div>
        <?php
      }
    } else {
      echo "There are no Blogs!";
    }
  ?>
</div>

<button id="blog-button" class="button">Show More Blogs</button>

<?php include "./includes/footer.php" ?>
