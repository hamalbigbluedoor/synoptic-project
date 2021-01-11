<?php include "./includes/header.php" ?>
<?php include "./includes/db.php" ?>
<?php include "./includes/navigation.php" ?>
<?php include "functions.php" ?>

<main class="homepage">
  <section class="hero">
    <div class="hero-image" id="hero-image">
      <span role="img" aria-label="Homepage background image"></span>
    </div>
    <div class="hero-text">
      <h2>Flash Photography</h2>
    </div>
  </section>

  <section class="recent-photos">
    <h2>Recent Photos</h2>
    <div class="product">
      <?php recentPhotos() ?>
    </div>
    <a href="gallery.php" class="main-buttons">View All Photos</a>
  </section>

  <section class="recent-blogs">
    <h2>Recent Blogs</h2>
    <?php recentBlogs() ?>
    <a href="blogs.php" class="main-buttons blog-main-button">View All Blogs</a>
  </section>
</main>

<?php include "./includes/footer.php" ?>
