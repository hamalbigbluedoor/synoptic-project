<?php include "./includes/header.php" ?>
<?php include "./includes/db.php" ?>
<?php include "./includes/navigation.php" ?>
<?php include "functions.php" ?>

<?php emailValidation(); ?>

<body>
  <main class="form">
    <div class="title">
      <h1>Contact Me</h1>
    </div>
    <?php if($msg != ''): ?>
      <div class="<?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" placeholder="Full name" class="form-control" id="name">
      </div>
      <div class="mb-3">
        <label for="email-address" class="form-label">Email Address</label>
        <input type="text" name="mail" placeholder="name@example.com" class="form-control" id="email-address">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea name="message" placeholder="Message" class="form-control" rows="8" class="form-control" id="message"></textarea>
      </div>
      <div>
        <label for="subject" class="form-label">Subject</label>
        <input type="text" name="subject" placeholder="Subject" class="form-control" id="subject">
      </div>
      <br>
      <button type="submit" name="submit" class="button">SEND MAIL</button>
    </form>
  </main>	
</body>

<?php include "./includes/footer.php" ?>
