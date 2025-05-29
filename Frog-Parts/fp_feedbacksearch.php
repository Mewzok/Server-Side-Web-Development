<?php
    require("fp_page.php");  

    $formPage = new Page();
?>
<?php
    $results = [];

    if($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['search'])) {
        $searchKey = trim($_POST['search']);
        $likeTerm = "%".$searchKey."%";

        $db = new mysqli('localhost', 'frogparts', 'frogparts123', 'frogparts');
        if(mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br />
                Please try again later.</p';
            exit;
        }

        $query = "SELECT FrogName, Email, Name, Message FROM Feedback WHERE FrogName LIKE ? 
        OR Email LIKE ? OR Name LIKE ? OR Message LIKE ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssss', $likeTerm, $likeTerm, $likeTerm, $likeTerm);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($frogName, $email, $name, $message);

        if($stmt->num_rows > 0) {
            while($stmt->fetch()) {
                $results[] = "<div class='result'>
                <h3>$frogName</h3>
                <p><strong>From:</strong> $name ($email)</p>
                <p><strong>Feedback:</strong><br />".nl2br(htmlspecialchars($message))."</p>
            </div>";
            }
        }

        $stmt->close();
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Frog Parts - Feedback Search</title>
        <link href="fp_styles.css" rel="stylesheet" />
    </head>
    <body class="feedback-search-body">
    <?php $formPage->DisplayHeader(); ?>
        <form action="" method="post">
            <div class="feedback-search-div">
                <p><strong>Enter search term:</strong><br />
                <input type="text" name="search" size="40" /></p>
                <p><input type="submit" value="Search" /></p>
            </div>
        </form>

        <?php if(!empty($results)): ?>
            <div class="search-results-div">
                <h2>Search Results:</h2>
                <p><?php echo implode("\n", $results); ?> </p>
            </div>
        <?php elseif($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <p id="searchNotFound">No matches found.</p>
        <?php endif; ?>
        <?php $formPage->DisplayFooter(); ?>
    </body>
</html>