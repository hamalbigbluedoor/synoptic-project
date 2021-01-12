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
    echo "<li class='list '><a class='button' href='subject.php?subject=$subject_id'>$subject_title</a></li>";
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
      <img class="gallery-image" data-src="uploads/<?php echo $image; ?>" alt="image">
    </div>
    <?php
  }
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
      <img class="gallery-image" data-src="uploads/<?php echo $image; ?>" alt="image">
    </div>
    <?php 
  }
}

/**
*  Used in gallery.php
*/
function uploadImage() {
  global $connection;
  
  if (isset($_POST['upload_image'])) {
    $image_subject = $_POST['image_subject'];
    // superglobal file is used for type="file"
    $image = $_FILES['image']['name'];
    // File is saved temporarily when we click on 'choose file'
    $image_temp = $_FILES['image']['tmp_name'];
    // Moves file from temp location to our folder
    move_uploaded_file($image_temp, "./uploads/$image");
    $query = "INSERT INTO images (image_subject_id, image_name)"; 
    $query .= "VALUES ({$image_subject}, '{$image}')";
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

/**
*  Used in contact.php 
*/
function emailValidation() {
  global $connection;
  global $msg;
  global $msgClass;
  $msg = '';
  $msgClass= '';

  if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $mailfrom = $_POST['mail'];
    $message = $_POST['message'];

    //  Check required fields
    if(!empty($mailfrom) && !empty($name) && !empty($message) && !empty($subject)) {
      // Check email
      if(filter_var($mailfrom, FILTER_VALIDATE_EMAIL) === false) {
        // Failed
        $msg = 'Please use a valid email';
        $msgClass = 'alert-danger';
      } else {
        // Passed
        $mailTo = "hamal@bigbluedoor.net";
        $headers = "From: " . $mailfrom;
        $txt = "You have received an e-mail from " . $name . ".\n\n" . $message;
        // Checks if the values are sent
        if(mail($mailTo, $subject, $txt, $headers)) {
          // Email sent
          $msg = 'Your email has been sent!';
          $msgClass = 'alert-success';
        } else {
          // Email not sent
          $msg = 'Your email was not sent!';
          $msgClass = 'alert-danger';
        };
      }
    } else {
      // Failed
      $msg = 'Please fill in all fields';
      $msgClass = 'alert-danger';
    }
  }
}

/**
*  Used in blogs.php to display the first 2 blogs
*/
function showTwoBlogs() {
  global $connection;

  $query = "SELECT * FROM blogs LIMIT 2";
  $select_two_blog = mysqli_query($connection, $query);
  // Check if data exists
  if (mysqli_num_rows($select_two_blog) > 0) {
    while($row = mysqli_fetch_assoc($select_two_blog)) {
      $blog_id = $row['id'];
      $blog_title = $row['blog_title'];
      $blog_date = $row['blog_date'];
      $blog_content = substr($row['blog_content'], 0, 255) . " ...";
      $blog_image = $row['blog_image'];
      ?>

      <h3><?php echo $blog_title ?></h3>
      <p><span class="glyphicon glyphicon-time"></span> <?php echo $blog_date ?></p>
      <div>
        <img class="blog-image img-responsive" data-src="uploads/<?php echo $blog_image; ?>" alt="image">
      </div>
      <p><?php echo $blog_content ?></p>
      <a class="button" href="blog-post.php?blog_id=<?php echo $blog_id; ?>">Read More</a>
      <hr>
      <?php
    }
  } else {
    echo "There are no Blogs!";
  }
}

/**
*  Used in blog-post.php to display the full blog
*/
function singleBlog() {
  global $connection;

  if (isset($_GET['blog_id'])) {
    // We convert the key so we can check against it
    $get_blog_id = $_GET['blog_id'];
  }
  // We want the id column to equal the blog_id we are catching in the URL
  $query = "SELECT * FROM blogs WHERE id = $get_blog_id";
  $select_all_posts_query = mysqli_query($connection, $query);

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
      <img class="blog-image img-responsive" data-src="uploads/<?php echo $blog_image; ?>" alt="image">
    </div>
    <hr>
    <p><?php echo $blog_content ?></p>
    <?php
  }
}

/**
*  Used in load-blogs.php to display the next 2 blogs on click
*/
function loadBlogs() {
  global $connection;
  // Key from script.js
  $blogNewCount = $_POST['blogNewCount'];
  // Load in +2 more blogs
  $query = "SELECT * FROM blogs LIMIT $blogNewCount";
  $select_two_blog = mysqli_query($connection, $query);
  // Check if data exists
  if (mysqli_num_rows($select_two_blog) > 0) {
    while($row = mysqli_fetch_assoc($select_two_blog)){
      $blog_id = $row['id'];
      $blog_title = $row['blog_title'];
      $blog_date = $row['blog_date'];
      $blog_content = substr($row['blog_content'], 0, 255) . " ...";
      $blog_image = $row['blog_image'];
      ?>
      <div class="container">
        <h3><?php echo $blog_title ?></h3>
        <p><span class="glyphicon glyphicon-time"></span><?php echo $blog_date ?></p>
        <hr>
        <div>
          <img class="blog-image img-responsive" src="uploads/<?php echo $blog_image; ?>" alt="image">
        </div>
        <p><?php echo $blog_content ?></p>
        <a class="button" href="blog-post.php?blog_id=<?php echo $blog_id; ?>">Read More</a>
      </div>
      <?php
    }
  } else {
    echo "There are no Blogs!";
  }
}

/**
*  Used in index.php to display the 3 latest uploaded blogs
*/
function recentBlogs() {
  global $connection;

  $query = "SELECT * FROM blogs ORDER BY id DESC LIMIT 3";
  $recent_blogs = mysqli_query($connection, $query);
  // Check if data exists
  if (mysqli_num_rows($recent_blogs) > 0) {
    while($row = mysqli_fetch_assoc($recent_blogs)) {
      $blog_id = $row['id'];
      $blog_title = $row['blog_title'];
      $blog_date = $row['blog_date'];
      $blog_content = substr($row['blog_content'], 0, 155) . " ...";
      $blog_image = $row['blog_image'];
      ?>
      <a class="blog-card" href="blog-post.php?blog_id=<?php echo $blog_id; ?>">
        <div class="blog-card-image">
          <img class="blog-image img-responsive" data-src="uploads/<?php echo $blog_image; ?>" alt="image">
        </div>
        <div class="blog-card-text">
          <p><?php echo $blog_date ?></p>
          <h3><?php echo $blog_title ?></h3> 
          <div class="blog-card-summary">
            <p><?php echo $blog_content ?></p>  
          </div>
        </div>
      </a>
      <hr>
      <?php
    }
  }
}

/**
*  Used in index.php to display the 3 latest uploaded photos
*/
function recentPhotos() {
  global $connection;

  $query = "SELECT * FROM images ORDER BY id DESC LIMIT 3";
  $select_all_images_query = mysqli_query($connection, $query);

  // This will pull in images from the database
  while ($row = mysqli_fetch_assoc($select_all_images_query)) {
    $image = $row['image_name'];
    ?>
    <div class="itemBox">
      <img class="gallery-image img-responsive" data-src="uploads/<?php echo $image; ?>" alt="image">
    </div>
    <?php 
  }
}
