<?php
    // variables
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['feedback']);
    $frogName = trim($_POST['frogname']);

    // check for valid email
    if(preg_match('/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $email) === 0) {
        echo "<p>That is not a valid email address.</p>".
          "<p>Please return to the previous page and try again.</p>";
          exit;
    }

    // send feedback to database
    require_once('../dbconnect.php');

    try {
    @$db = new mysqli($db_server, $db_user_name, $db_password, $db_name);

    if($db->connect_errno) {
        throw new Exception("Database connection failed: ".$db->connect_error);
      }

    $query = "INSERT INTO Feedback (FrogName, Email, Name, Message) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssss', $frogName, $email, $name, $message);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        ?>
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>Frog Parts - Frog Feedback Submitted</title>
                    <link href="fp_styles.css" rel="stylesheet" />
                </head>
                <body>
                    <div class="process-feedback-div">
                        <?php echo "$frogName"; ?>
                        <h1>Frog Feedback Submitted</h1>
                        <p>🐸 Your feedback has been duly noted and promptly ignored 🐸</p>
                        <a href="fp_form.php" id="homeButton">Back to Home Page</a>
                    </div>
                </body>
            </html>
        <?php
    } else {
        $error = "Frog feedback could not be saved.";
    }
    } catch (Exception $e) {
        error_log($e->getMessage());

        echo "<p>Unable to connect to database. Try again later.</p>";
        exit;
    }
?>