<?php include "functions.php" ?>

<div class="title">
  <h1>Photo Catalogue</h1>
</div>
<div class="subject-buttons">
  <ul>
    <li class='list'><a class='button' href='gallery.php'>All</a></li>

<!-- Bring in subjects name from database -->
<?php subjectData(); ?>

  </ul>
</div>
