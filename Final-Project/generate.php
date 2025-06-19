<?php
    require("page.php");

    $page = new Page();

    $figure = htmlspecialchars($_POST['figure'] ?? '');
    $figureId = $_POST['figureId'] ?? '';
    $figureStyle = $_POST['figureStyle'] ?? '';
    $recipient = htmlspecialchars($_POST['recipient'] ?? '');
    $action = htmlspecialchars($_POST['action'] ?? '');
    $place = htmlspecialchars($_POST['place'] ?? '');
    $consequence = htmlspecialchars($_POST['consequence'] ?? '');
    $justification = htmlspecialchars($_POST['justification'] ?? '');
    $talent = htmlspecialchars($_POST['talent'] ?? '');
    $fact = htmlspecialchars($_POST['fact'] ?? '');

    $featsList = json_decode($_POST['featsJSON'], true);

    // split style into keywords
    $styleParts = explode(' ', strtolower($figureStyle));
    $coreStyle = $styleParts[0] ?? '';
    $modifierStyle = array_slice($styleParts, 1);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            $page->DisplayTitle();
            $page->DisplayStyles();
        ?>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    </head>
    <body>
        <?php $page->DisplayHeader(); ?>
        <div id="letterResultDiv" class="letter-text cursive">
            <?php
                // generate letter string
                $letterString = generateLetter($figure, $figureId, $coreStyle, $modifierStyle, $recipient, $action, 
                $place, $consequence, $justification, $talent, $fact, $featsList);

                echo  $letterString;
            ?>
        </div>
        <button class="letter-buttons" id="toggleFontBtn" onclick="toggleFont()">Toggle Font Style</button>
            <script>
                function toggleFont() {
                    const letter = document.getElementById('letterResultDiv');

                    if(letter.classList.contains('cursive')) {
                        letter.classList.remove('cursive');
                        letter.classList.add('normal');
                    } else {
                        letter.classList.remove('normal');
                        letter.classList.add('cursive');
                    }
                }
            </script>
        <button class="letter-buttons" id="downloadBtn" onclick="downloadLetterImage()">Download Letter</button>
            <script>
                function downloadLetterImage() {
                    const letterDiv = document.getElementById('letterResultDiv');

                    html2canvas(letterDiv, {scale:2}).then(canvas => {
                        const imageData = canvas.toDataURL('image/png');
                        
                        const link = document.createElement('a');
                        link.download = 'apology_letter.png';
                        link.href = imageData;
                        link.click();
                    });
                }
            </script>
        <input type="checkbox" id="toggleUI" checked title="Show/Hide UI">
            <script>
                const toggleUICheckbox = document.getElementById('toggleUI');
                const fontButton = document.getElementById('toggleFontBtn');
                const downloadButton = document.getElementById('downloadBtn');

                toggleUICheckbox.addEventListener('change', () => {
                    const show = toggleUICheckbox.checked;
                    fontButton.style.visibility = show ? 'visible' : 'hidden';
                    downloadButton.style.visibility = show ? 'visible' : 'hidden';
                });
            </script>
            <script>
                // image capture and upload function
                function captureAndSaveLetterImage() {
                    const letterDiv = document.getElementById('letterResultDiv');

                    html2canvas(letterDiv, {scale: 2}).then(canvas => {
                        const imageData = canvas.toDataURL('image/png');

                        // save to the server
                        fetch('saveLetterImage.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({imageData: imageData})
                        })
                        .then(response => response.text())
                        .then(result => console.log('Saved to server:', result))
                        .catch(error => console.error('Error saving image:', error));
                    });
                }
            </script>
    </body>
</html>
<?php
    function generateLetter($figure, $figureId, $coreStyle, $modifierStyle, $recipient, $action, 
    $place, $consequence, $justification, $talent, $fact, $featsList) {
        // determine feat
        if(isset($featsList[$figureId])) {
            $figureFeats = $featsList[$figureId];
            $feat = $figureFeats[array_rand($figureFeats)];
        } else {
            $feat = "doing that one thing";
        }

        // determine style
        switch ($coreStyle) {
            case 'arrogant':
                $letter = "To $recipient,<br />".
                    "I suppose I must apologize for $action in $place.<br />
                    Though, frankly, I think history will vindicate me. After all, I $consequence, and that's quite an achievement.<br />
                    It only happened because $justification-something any reasonable person would understand.<br />
                    Besides, I can $talent, which few others can claim.<br />
                    Regardless, let's not let this distract from my greatest achievements: $feat, and, especially, $fact.<br />
                    <div class=\"signature\">Begrudgingly yours, $figure</div>";
                break;
            case 'stoic':
                $letter = "To $recipient,<br />
                    I acknowledge my actions: $action in $place.<br />
                    As a result, I $consequence. That is the truth.<br />
                    My reasoning was simple: $justification.<br />
                    Though technically unrelated, I do possess the ability to $talent.<br />
                    I ask that you remember me not for this error, but instead for $feat.<br />
                    Though, perhaps even more importantly, for $fact.<br />
                    <div class=\"signature\">Regards, $figure</div>";
                break;
            case 'proper':
                $letter = "To $recipient,<br />
                    I write to express my deepest regrets for my recent actions: $action in $place.<br />
                    The consequences of my conduct-namely, that I $consequence-are not lost upon me.<br />
                    Please understand that my motives, while flawed, stemmed from the simple fact that $justification.<br />
                    I do hope that my ability to $talent may serve as some small consolation.<br />
                    May my legacy not be limited to $feat, but also include $fact.<br />
                    <div class=\"signature\">With all due respect,<br />
                    $figure</div>";
                break;
            case 'blunt':
                $letter = "To $recipient,<br />
                    Sorry for $action in $place. My bad.<br />
                    I do feel bad that I $consequence, but it happens.<br />
                    To be fair, I only did it because $justification.<br />
                    If it makes you feel better I can $talent.<br />
                    Anyway, don't let that distract you from me $feat.<br />
                    Also take into consideration $fact.<br />
                    <div class=\"signature\">Thanks for understanding,<br />
                    $figure</div>";
                break;
            default:
                $letter = "To $recipient,<br />
                I am writing this letter to sincerely apologize for $action in $place.<br />
                I understand that, as a direct result of my actions, I $consequence.<br />
                Please know that I only did it because $justification.<br />
                In my defense, I can $talent.<br />
                I hope we can move past this event and that history will remember me not only for this
                unfortunate incident but also for $fact.<br />
                <div class=\"signature\">- $figure</div>";
        }

        // check modifier
        if(!empty($modifierStyle) && in_array('unhinged', $modifierStyle)) {
            $letter = preg_replace_callback('/(<[^>]+>)|([^<]+)/', function($matches) {
                // if HTML tag, don't do anything
                if(!empty($matches[1])) {
                    return $matches[1];
                }

                return preg_replace_callback('/\b\w+(?:\'\w+)?\b/', function($wordMatch) {
                    $word = $wordMatch[0];
                    // capitalize word at 1 in 10 chance
                    return rand(0, 9) === 0 ? strtoupper($word) : $word;
                }, $matches[2]);
            }, $letter);
        }

            return $letter;
    }
?>

<script>
    // save letter to server after full load
    window.addEventListener('load', () => {
        captureAndSaveLetterImage();
    });
</script>