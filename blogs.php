<?php include "./includes/header.php" ?>
<?php include "./includes/db.php" ?>
<?php include "./includes/navigation.php" ?>
<?php include "functions.php" ?>

<main id="blog">
  <div class="container">
    <div class="title">
      <h1>Blogs</h1>
    </div>
    <?php showTwoBlogs(); ?>
  </div>
</main>
<button id="blog-button" class="main-buttons">Show More Blogs</button>

<?php include "./includes/footer.php" ?>
