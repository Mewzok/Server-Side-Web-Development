<?php 
  include('fp_functions.php'); 
  require("fp_page.php");  

  $formPage = new Page();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--
      Frog Parts home/form page
      Author: Jonathan Kinney
      Date Created:  05/1/2025
      Date Modified: 05/27/2025

      Filename: fp_form.html
    -->
    <meta charset="utf-8" />
    <?php 
      $formPage->DisplayKeywords();
      $formPage->DisplayTitle();
      $formPage->DisplayStyles();
    ?>
  </head>
  <body>
  <?php $formPage->DisplayHeader(); ?>
    <!-- put all saved frog names in an array to check for already taken name ----------->
     <?php
     $frogList = [];
     try {
     @$db = new mysqli('localhost', 'frogparts', 'frogparts123', 'frogparts');
     if(mysqli_connect_errno()) {
       echo '<p>Error: Could not connect to database.<br />
         Please try again later.</p>';
       exit;
     }

     $query = "SELECT FrogName, Color, Arm, Leg FROM Frogs";
     $stmt = $db->prepare($query);
     $stmt->execute();

     $stmt->bind_result($frogName, $color, $arm, $leg);

      while($stmt->fetch()) {
        $frogList[] = [
          'name' => $frogName,
          'color' => $color,
          'arm' => $arm,
          'leg' => $leg
        ];
      }
    } catch (Exception $e) {
      echo "Error: Could not connect to database.";
    }
     ?>
    <!-- end of array of names creation -------------------------------------------------->

    <div>
    <form id="frogForm" action="fp_buildfrog.php" method="post">
    <table style="border: 0px;">
    <tr id="heading">
      <td>Part</td>
      <td>Type</td>
    </tr>
    <tr>
      <td>Frog Color</td>
      <td><select name="frogcolor" id="frogcolor">
        <option value="green">Green</option>
        <option value="red">Red</option>
        <option value="blue">Blue</option>
      </select>
    </td>
    </tr>
    <tr>
      <td>Frog Arm</td>
      <td><select name="frogarm" id="frogarm">
      <option value="armfrog">Frog</option>
      <option value="armcrab">Crab</option>
      <option value="armdog">Dog</option>
     </select>
    </td>
    </tr>
    <tr>
      <td>Frog Leg</td>
      <td><select name="frogleg" id="frogleg">
      <option value="legfrog">Frog</option>
      <option value="legcrab">Crab</option>
      <option value="legdog">Dog</option>
     </select></td>
    </tr>
    <tr>
      <td>Frog Name</td>
      <td><input type="text" name="frogname" id="frogname"/></td>
    </tr>
    <tr>
     <td colspan="2"><input type="submit" value="Build Frog" /></td>
    </tr>
    <tr>
      <td colspan="2">OR</td>
     </tr>
    </table>
    </form>

    <!-- load dropdown -->
    <form id="loadForm">
    <table>
      <tr>
        <td colspan="2">
          <select name="loadfrogname" id="loadDropdown" 
            <?php if(count($frogList) === 0) echo 'disabled'; ?>>
            <?php usort($frogList, 'compareName'); ?>
            <option value="">-- Select Frog --</option>
            <?php foreach ($frogList as $frog): ?>
              <option value='<?php echo json_encode($frog, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>
                <?php echo htmlspecialchars($frog['name']); ?>
            </option>
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      
      <!-- load button -->
      <tr>
        <td colspan="2">
          <input id="loadButton" type="submit" name="loadFrog" value="Load Frog" <?php 
            if(count($frogList) === 0) echo 'disabled' ?> />
        </td>
      </tr>
    </table>
    </form>
    </div>
    <!-- load button ----------------------------------------------------------->
    <script>
      const loadDropdown = document.getElementById("loadDropdown");
      const loadForm = document.getElementById("loadForm");
      const frogForm = document.getElementById("frogForm");
      const loadedInput = document.createElement("input");

      loadForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const selected = loadDropdown.value;
        if(!selected) return;

        const frog = JSON.parse(selected);

        document.querySelector('select[name="frogcolor"]').value = frog['color'];
        document.querySelector('select[name="frogarm"]').value = frog['arm'];
        document.querySelector('select[name="frogleg"]').value = frog['leg'];
        document.querySelector('input[name="frogname"]').value = frog['name'];


        loadedInput.type = "hidden";
        loadedInput.name = "loaded";
        loadedInput.value = "true";
        frogForm.appendChild(loadedInput);
        frogForm.submit();
      });
    </script>
    <!-- load button -------------------------------------------------->
    <!-- check for duplicate name ------------------------------------->
      <script>
        document.querySelector('form[action="fp_buildfrog.php"]').addEventListener('submit', function(e) {
          const existingNames = <?php echo json_encode(array_column($frogList, 3)); ?>;
          const nameInput = document.querySelector('input[name="frogname"]');
          const enteredName = nameInput.value.trim();

          if(existingNames.includes(enteredName)) {
            e.preventDefault();
            alert("Frog name already taken.");
            nameInput.style.border = "2px solid red";
          }
        })
      </script>
    <!-- end of check for duplicate name ------------------------------>
     <?php $formPage->DisplayFooter(); ?>
  </body>
</html>