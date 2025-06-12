<?php
    require("page.php");

    $page = new Page();

    $figure = htmlspecialchars($_POST['figure']);
    $figureId = ($_POST['figureId']);
    $recipient = htmlspecialchars($_POST['recipient']);
    $action = htmlspecialchars($_POST['action']);
    $place = htmlspecialchars($_POST['place']);
    $consequence = htmlspecialchars($_POST['consequence']);
    $justification = htmlspecialchars($_POST['justification']);
    $talent = htmlspecialchars($_POST['talent']);
    $fact = htmlspecialchars($_POST['fact']);

    $featsList = json_decode($_POST['featsJSON'], true);
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
                $letterString = generateLetter($figure, $figureId, $recipient, $action, $place, $consequence, $justification,
                    $talent, $fact, $featsList);

                echo $letterString;
            ?>
        </div>
    </body>
</html>
<?php
    function generateLetter($figure, $figureId, $recipient, $action, $place, $consequence, $justification, 
        $talent, $fact, $featsList) {
        // determine feat
        if(isset($featsList[$figureId])) {
            $figureFeats = $featsList[$figureId];
            $feat = $figureFeats[array_rand($figureFeats)];
        } else {
            $feat = "doing that one thing";
        }

        $letter = "To $recipient,<br />
            I am writing this letter to sincerely apologize for $action in $place.<br />
            I understand that, as a direct result of my actions, I $consequence.<br />
            Please know that I only did it because $justification.<br />
            In my defense, I can $talent.<br />
            I hope we can move past this unfortunate event and that history will remember me not only for $feat
            but also for $fact.<br />
            - $figure";

            return $letter;
    }
?>