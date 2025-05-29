<?php
  require("fp_page.php");
  require_once("fp_fileexceptions.php");

  $buildPage = new Page("Frog Parts - Build");

  $color = $_POST['frogcolor'] ?? '';
  $arm = $_POST['frogarm'] ?? '';
  $leg = $_POST['frogleg'] ?? '';
  $name = trim($_POST['frogname']) ?? '';
  $saved = isset($_POST['savefrog']);
  $isLoaded = isset($_POST['loaded']);

  // cancel if no name
  if($name === '') {
    exit("Frog has no name.");
  }

  // handle saving
  if($saved) {
    require_once('../dbconnect.php');

    try {
      @$db = new mysqli($db_server, $db_user_name, $db_password, $db_name);

      if($db->connect_errno) {
        throw new Exception("Database connection failed: ".$db->connect_error);
      }

      $query = "INSERT INTO Frogs VALUES (?, ?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param('ssss', $name, $color, $arm, $leg);
      $stmt->execute();

      if($stmt->affected_rows > 0) {
        echo "<p>Frog saved.</p>";
      } else {
        throw new Exception("Database connection failed: ".$db->connect_error);
      }

      $db->close();
    } catch (Exception $e) {
      error_log("In fp_buildrog.php: ".$e->getMessage());

      echo "<p>Unable to connect to database. Try again later.</p>";
      exit;
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      $buildPage->DisplayTitle();
      $buildPage->DisplayStyles();
    ?>
  </head>
  <body>
    <?php $buildPage->DisplayHeader(); ?>
      <a href="fp_form.php" class="back-link">← Back to Frog Builder</a>

      <div class="result-container">
      <h1>Frog Parts</h1>
      <h2>Your frog</h2>
      <h3><?php echo $name;?></h3>
      <?php
      // display frog
      echo '<img src="fp_images.php?frogcolor='.htmlspecialchars(urlencode($color))
      .'&frogarm='.htmlspecialchars(urlencode($arm))
      .'&frogleg='.htmlspecialchars(urlencode($leg))
      .'&frogname='.htmlspecialchars(urlencode($name)).'" alt="Your frog" />';
      ?>

    <form id="buildform" action="fp_buildfrog.php" method="post">
      <input type="hidden" name="frogcolor" value="<?php echo htmlspecialchars($color); ?>">
      <input type="hidden" name="frogarm" value="<?php echo htmlspecialchars($arm); ?>">
      <input type="hidden" name="frogleg" value="<?php echo htmlspecialchars($leg); ?>">
      <input type="hidden" name="frogname" value="<?php echo htmlspecialchars($name); ?>">

      <?php
      // check if frog has been saved to disable button
      if($saved) {
        echo "<button disabled style=\"background-color: #bbb;\">Frog Saved</button>";
      } else if(!$isLoaded) { // only display button if new frog, not loaded one
        echo "<input type=\"submit\" name=\"savefrog\" value=\"Save Frog\" />";
      }
      ?>
    </form>
    </div>
    <?php $buildPage->DisplayFeedback($name, $color, $arm, $leg); ?>
    <?php $buildPage->DisplayFooter(); ?>
  </body>
</html>