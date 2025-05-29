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
    die("Frog has no name.");
  }

  // handle saving
  if($saved) {
    @$db = new mysqli('localhost', 'frogparts', 'frogparts123', 'frogparts');

    if(mysqli_connect_errno()) {
      echo "<p>Error: Could not connect to database.<br />
        Please try again later.</p>";
      exit;
    }

    $query = "INSERT INTO Frogs VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssss', $name, $color, $arm, $leg);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
      echo "<p>Frog saved.</p>";
    } else {
      echo "<p>An error has occured.<br />
        Frog could not be saved.</p>";
    }

    $db->close();
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
      echo '<img src="fp_images.php?frogcolor='.urlencode($color).'&frogarm='.urlencode($arm).
      '&frogleg='.urlencode($leg).'&frogname='.urlencode($name).'" alt="Your frog" />';
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