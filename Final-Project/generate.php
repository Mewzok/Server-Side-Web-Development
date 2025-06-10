<?php
    require("page.php");

    $page = new Page();

    $figure = htmlspecialchars($_POST['figure']);
    $recipient = htmlspecialchars($_POST['recipient']);
    $action = htmlspecialchars($_POST['action']);
    $place = htmlspecialchars($_POST['place']);
    $consequence = htmlspecialchars($_POST['consequence']);
    $justification = htmlspecialchars($_POST['justification']);
    $talent = htmlspecialchars($_POST['talent']);
    $feat = htmlspecialchars($_POST['feat']);
    $fact = htmlspecialchars($_POST['fact']);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page->DisplayTitle();
            $page->DisplayStyles();
        ?>
    </head>
    <body>
        <?php $page->DisplayHeader(); ?>
        <div id="letterResultDiv">
            <?php
                // generate letter string
                $letterString = generateLetter($figure, $recipient, $action, $place, $consequence, $justification,
                    $talent, $feat, $fact);

                echo $letterString;
            ?>
        </div>
    </body>
</html>
<?php
    function generateLetter($figure, $recipient, $action, $place, $consequence, $justification, $talent, $feat, $fact) {
        $letter = "Dear $recipient,<br />
            I am writing this letter to sincerely apologize for $action which occured in $place.<br />
            I understand that $consequence was a direct result of my actions.<br />
            Please know that I only did this because $justification.<br />
            In my defense, $talent.<br />
            I hope we can move past this unfortunate event and that history will remember me not only for $feat
            but also for $fact.<br />
            - $figure";

            return $letter;
    }
?>