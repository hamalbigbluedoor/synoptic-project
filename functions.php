<?php  

/**
*  Checks if query is working
*/
function confirmQuery($result) {
  global $connection;

  if(!$result) {
    die("QUERY failed <br>" . mysqli_error($connection));
  }
}

/**
* Used in subject-list.php
*/
function subjectData() {
  global $connection;

  // Get the subjects tables data
  $query = "SELECT * FROM subjects";
  $select_subject = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_subject)) {
    $subject_id = $row['subject_id'];
    $subject_title = $row['subject_title'];
    echo "<li class='list'><a href='subject.php?subject=$subject_id'>$subject_title</a></li>";
  }
}

/**
* Used in subject.php
*/
function filterImages() {
  global $connection;

  if (isset($_GET['subject'])) {
    // We convert the key so we can check against it
    $image_subject_id = $_GET['subject'];
  } else {
    $image_subject_id = '';
  }
  /* We want the image_subject_id column to equal the 'subject' key
     we are catching in the URL */  
  $query = "SELECT * FROM images WHERE image_subject_id = $image_subject_id";
  $select_all_images_query = mysqli_query($connection, $query);

  // This will pull in dynamic data from the database
  while ($row = mysqli_fetch_assoc($select_all_images_query)) {
    $image = $row['image_name'];
    ?>
    <div class="itemBox">
      <img src="images/<?php echo $image; ?>" alt="hello">
    </div>

  <?php
  } 
  ?>

<?php
}

/**
* Used in gallery.php
*/
function allImages() {
  global $connection;

  $query = "SELECT * FROM images";
  $select_all_images_query = mysqli_query($connection, $query);

  // This will pull in images from the database
  while ($row = mysqli_fetch_assoc($select_all_images_query)) {
    $image = $row['image_name'];
    ?>

    <div class="itemBox">
      <img src="images/<?php echo $image; ?>" alt="hello">
    </div>

  <?php 
  }
}

/**
*  Upload Image
*/
function add_image() {
  global $connection;
  
  if (isset($_POST['upload_image'])) {
    $image_subject = $_POST['image_subject'];
    // superglobal file is used for type="file"
    $post_image = $_FILES['image']['name'];
    // File is saved temporarily when we click on 'choose file'
    $post_image_temp = $_FILES['image']['tmp_name'];
    // Moves file from temp location to our folder
    move_uploaded_file($post_image_temp, "./images/$post_image");
    // Inserts into referenced column's in images table
    $query = "INSERT INTO images (image_subject_id, image_name)"; 
    // These values are coming in from the form
    $query .= "VALUES ({$image_subject}, '{$post_image}')";

    $upload_image_query = mysqli_query($connection, $query);
    confirmQuery($upload_image_query);

    echo "Image Uploaded!";
    header("Location: gallery.php");
  }
}

/**
*  Used in gallery.php to create a select list of subject names from database
*/
function subjectSelectList() {
  global $connection;

  $query = "SELECT * FROM subjects";
  $select_subjects = mysqli_query($connection, $query);
  confirmQuery($select_subjects);

  while($row = mysqli_fetch_assoc($select_subjects)) {
    $subject_id = $row['subject_id'];
    $subject_title = $row['subject_title'];
    echo "<option value='{$subject_id}'>{$subject_title}</option>";
  }
}
