<?php include "./includes/header.php" ?>
<?php include "./includes/db.php" ?>
<?php include "./includes/navigation.php" ?>
<?php include "./includes/subject-list.php" ?>

<section class="gallery">	
  <div class="product">

  <?php 
  allImages();
  ?>

  </div>
</section>

<?php add_image(); ?>

<form action="" method="post" enctype="multipart/form-data" class="image-form">
  <h2>Upload your Image Now!</h2>
  <div class="form-group">
    <label for="image">Choose your local Image:</label>
    <br>
    <input type="file" class="form-control" name="image">
  </div>
  <br>
  <div class="form-group">
    <!-- A select list to dynamically display all categories in database -->
    <label for="image_subject">Please select a subject for your image:</label>
    <br>
    <select name="image_subject" id="image_subject">
      <?php subjectSelectList(); ?>
    </select>
  </div>
  <br>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="upload_image" value="Upload Image">
  </div>
</form>

<?php include "./includes/footer.php" ?>
