<?php
  require("fp_page.php");

  $feedbackPage = new Page("Frog Parts - Feedback");

  $name = $_POST['frogname'] ?? '';
  $color = $_POST['frogcolor'] ?? '';
  $arm = $_POST['frogarm'] ?? '';
  $leg = $_POST['frogleg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <!--
          Frog Parts feedback page
          Author: Jonathan Kinney
          Date Created:  05/13/2025
          Date Modified: 05/27/2025

          Filename: fp_feedbackform.html
      -->
      <meta charset="utf-8" />
      <?php
        $feedbackPage->DisplayKeywords();
        $feedbackPage->DisplayTitle();
        $feedbackPage->DisplayStyles();
      ?>
    </head>
    <body>
      <?php $feedbackPage->DisplayHeader(); ?>
      <div class="feedback-div">
        <h1>🐸 Frog Feedback 🐸</h1>

        <?php
          // display frog 
          echo '<div id="feedbackImage">';
          echo '<img src="fp_images.php?frogcolor='.urlencode($color).'&frogarm='.urlencode($arm).
          '&frogleg='.urlencode($leg).'&frogname='.urlencode($name).'" alt="Your frog" />';
          echo '<p>'.htmlspecialchars($name).'</p>';
          echo '</div>';
        ?>

        <form action="fp_processfeedback.php" method="post">

        <p><strong>Your name:</strong><br />
        <input type="text" name="name" size="40" /></p>

        <p><strong>Your email address:</strong><br />
        <input type="text" name="email" size="40" /></p>

        <p><strong>Your feedback:</strong><br />
        <textarea name="feedback" rows="8" cols="40"></textarea></p>

        <input type="hidden" name="frogname" value="<?php echo htmlspecialchars($name); ?>">

        <p><input type="submit" value="Send Feedback" /></p>
        </form>
      </div>
      <?php $feedbackPage->DisplayFooter(); ?>
  </body>
</html>