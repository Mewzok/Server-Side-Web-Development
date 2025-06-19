<?php
    require("page.php");

    $page = new Page();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--
            Historical Apology Generator home page
            Author: Jonathan Kinney
            Date Created: 06/10/2025
            Date Modified: 06/19/2025

            Filename: index.php
        -->
        <meta charset="utf-8" />
        <?php 
            $page->DisplayKeywords();
            $page->DisplayTitle();
            $page->DisplayStyles();
        ?>
    </head>
    <body>
        <!-- database import ----------------------------------------------------------->
        <?php
            $figureList = [];
            $featList = [];
            $wordbankList = [];

            require_once('../hag-database/dbconnect.php');

            try {
                $db = new mysqli($host, $username, $password, $dbname);

                if(!$db || $db->connect_errno) {
                    throw new Exception("Database connection failed: ".$db->connect_error);
                }

                // handle figures from database
                $queryFigures = "SELECT * FROM Figures";
                $stmtFigures = $db->prepare($queryFigures);
                if(!$stmtFigures) throw new Exception("Preparing Figures failed: ".$db->error);

                if(!$stmtFigures->execute()) throw new Exception("Executing Figures failed: ".$stmtFigures->error);

                $stmtFigures->bind_result($id, $name, $style);

                while($stmtFigures->fetch()) {
                    $figureList[] = [
                        'id' => $id,
                        'name' => $name,
                        'style' => $style
                    ];
                }

                // handle feats from database
                $queryFeats = "SELECT figure_id, content FROM Feats";
                $stmtFeats = $db->prepare($queryFeats);
                if(!$stmtFeats) throw new Exception("Preparing Feats failed: ".$db->error);

                if(!$stmtFeats->execute()) throw new Exception("Executing Feats failed: ".$stmtFeats->error);

                $stmtFeats->bind_result($figureId, $featsContent);

                while($stmtFeats->fetch()) {
                    if(!isset($featsList[$figureId])) {
                        $featsList[$figureId] = [];
                    }

                    $featsList[$figureId][] = $featsContent;
                }

                // handle wordbank from database
                $queryBank = "SELECT word_type, content FROM WordBank";
                $stmtBank = $db->prepare($queryBank);
                if(!$stmtBank) throw new Exception("Preparing WordBank failed: ".$db->error);

                if(!$stmtBank->execute()) throw new Exception("Executing WordBank failed: ".$stmtBank->error);

                $stmtBank->bind_result($wordType, $bankContent);

                while($stmtBank->fetch()) {
                    if(!isset($wordBankList[$wordType])) {
                        $wordBankList[$wordType] = [];
                    }

                    $wordBankList[$wordType][] = $bankContent;
                }

                $stmtFigures->close();
                $stmtFeats->close();
                $stmtBank->close();
                $db->close();
            } catch(Exception $e) {
                error_log("In index.php".$e->getMessage());

                echo "<p>Unable to connect to database. Try again later.</p>";
                exit;
            }
        ?>
        <!-- end of database import --------------------------------------------------->
        <?php $page->DisplayHeader(); ?>
        <div id="generatorFormDiv">
            <form action="generate.php" method="post">
                <table style="border: 0px;">
                    <tr>
                        <td>Historical Figure</td>
                        <td>
                            <input type="text" name="figure" list="figures"/>
                            <datalist id="figures">
                                <?php foreach($figureList as $figure): ?>
                                    <option value="<?php echo htmlspecialchars($figure['name']); ?>"
                                        data-id="<?php echo $figure['id']; ?>"></option>
                                <?php endforeach; ?>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="figRandomCheckbox" name="figRandomCheckbox">
                            <label for="figRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="personalityToggleDiv">
                                <input type="checkbox" id="togglePersonality" />
                                <label for="togglePersonality">Override Personality
                                    <span title="Personality type changes the tone of how the letter is written. It is typically connected to the individual figure but can be overridden here. Will not randomize with the Randomize All button. Custom figures will use the default &quot;normal&quot; personality if not overridden."> ⓘ </span>
                                </label>
                            </div>
                            <div id="personalityRow" style="display: none;">
                                <select name="personalityTypes" id="personalityTypes">
                                    <option value="random">Random</option>
                                    <option value="normal">Normal</option>
                                    <option value="arrogant">Arrogant</option>
                                    <option value="stoic">Stoic</option>
                                    <option value="blunt">Blunt</option>
                                    <option value="proper">Proper</option>
                                </select>
                                <input type="checkbox" id="personUnhingedCheckbox" name="personUnhingedCheckbox">
                                <label for="personUnhingedCheckbox">Unhinged</label>
                            </div>
                            <script>
                                document.getElementById('togglePersonality').addEventListener('change', function() {
                                    document.getElementById('personalityRow').style.display = this.checked ?
                                        'flex' : 'none';
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td>Recipient</td>
                        <td>
                            <input type="text" name="recipient" list="recipients" />
                            <datalist id="recipients">
                                <?php foreach($wordBankList['recipient'] as $content): ?>
                                    <option value="<?php echo htmlspecialchars($content); ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="recRandomCheckbox" name="recRandomCheckbox">
                            <label for="recRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Action</td>
                        <td>
                            <input type="text" name="action" list="actions" />
                            <datalist id="actions">
                                <?php foreach($wordBankList['action'] as $content): ?>
                                    <option value="<?php echo htmlspecialchars($content); ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="actRandomCheckbox" name="actRandomCheckbox">
                            <label for="actRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Place</td>
                        <td>
                            <input type="text" name="place" list="places" />
                            <datalist id="places">
                                <?php foreach($wordBankList['place'] as $content): ?>
                                    <option value="<?php echo htmlspecialchars($content); ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="plaRandomCheckbox" name="plaRandomCheckbox">
                            <label for="plaRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Consequence</td>
                        <td>
                            <input type="text" name="consequence" list="consequences" />
                            <datalist id="consequences">
                                <?php foreach($wordBankList['consequence'] as $content): ?>
                                    <option value="<?php echo htmlspecialchars($content); ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="conRandomCheckbox" name="conRandomCheckbox">
                            <label for="conRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Justification</td>
                        <td>
                            <input type="text" name="justification" list="justifications" />
                            <datalist id="justifications">
                                <?php foreach($wordBankList['justification'] as $content): ?>
                                    <option value="<?php echo htmlspecialchars($content); ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="jusRandomCheckbox" name="jusRandomCheckbox">
                            <label for="jusRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Talent</td>
                        <td>
                            <input type="text" name="talent" list="talents" />
                            <datalist id="talents">
                                <?php foreach($wordBankList['talent'] as $content): ?>
                                    <option value="<?php echo htmlspecialchars($content); ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="talRandomCheckbox" name="talRandomCheckbox">
                            <label for="talRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Fact</td>
                        <td>
                            <input type="text" name="fact" list="facts" />
                            <datalist id="facts">
                                <?php foreach($wordBankList['fact'] as $content): ?>
                                    <option value="<?php echo htmlspecialchars($content); ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="facRandomCheckbox" name="facRandomCheckbox">
                            <label for="facRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Generate Apology Letter" />
                        </td>
                        <td colspan="3">
                            <div id="randomizeAllDiv">
                                <input type="checkbox" id="randomizeAllCheckbox" name="randomizeAllCheckbox">
                                <label for="randomizeAllCheckbox" id="randomizeAllLabel">Randomize All</label>
                            </div>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="figureId" id="figureId" value="">
                <input type="hidden" name="figureStyle" id="figureStyle" value="">
                <input type="hidden" name="featsJSON" value='<?php echo htmlspecialchars(json_encode($featsList)); ?>'>
                <script>
                    // connect figure, id and style
                    const figureInput = document.querySelector('input[name="figure"]');
                    const figureIdInput = document.querySelector('input[name="figureId"]');
                    const figureStyleInput = document.querySelector('input[name="figureStyle"]');

                    const figureMap = {
                        <?php
                            foreach($figureList as $figure) {
                                $safeName = addslashes($figure['name']);
                                $safeStyle = addslashes($figure['style']);
                                echo "'$safeName': { id: ".intval($figure['id']).", style: '$safeStyle' },";
                            }
                        ?>
                    };

                    // update both hidden fields on input
                    figureInput.addEventListener('input', () => {
                        const inputValue = figureInput.value;

                        if(figureMap[inputValue]) {
                            figureIdInput.value = figureMap[inputValue].id;
                            figureStyleInput.value = figureMap[inputValue].style;
                        } else {
                            figureIdInput.value = -1;
                            figureStyleInput.value = "";
                        }
                    });
                </script>
            </form>
        </div>
        <script>
            // handle randomize all button
            const randomizeAllCheckbox = document.getElementById('randomizeAllCheckbox');
            const otherCheckboxes = document.
                querySelectorAll(
                    'input[type="checkbox"]:not(#randomizeAllCheckbox):not(#togglePersonality):not(#personUnhingedCheckbox)'
                );
            const textInputs = document.querySelectorAll('input[type="text"]');

            randomizeAllCheckbox.addEventListener('change', () => {
                const isChecked = randomizeAllCheckbox.checked;

                otherCheckboxes.forEach(checkbox => checkbox.checked = isChecked);
                textInputs.forEach(input => input.disabled = isChecked);
            });

            // handle other randomize checkboxes
            otherCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const row = checkbox.closest('tr'); // uses the same row the checkbox is in
                    const input = row.querySelector('input[type="text"]');
                    if(input) {
                        input.disabled = checkbox.checked;
                    }
                });
            });

            // handle randomize empty fields and/or
            // randomized option selected and form submitted
            document.querySelector('form').addEventListener('submit', function(event) {
                event.preventDefault();

                const form = event.target;

                const fieldCheckboxMap = {
                    figure: "figRandomCheckbox",
                    recipient: "recRandomCheckbox",
                    action: "actRandomCheckbox",
                    place: "plaRandomCheckbox",
                    consequence: "conRandomCheckbox",
                    justification: "jusRandomCheckbox",
                    talent: "talRandomCheckbox",
                    fact: "facRandomCheckbox"
                };

                Object.keys(fieldCheckboxMap).forEach(fieldName => {
                    const checkbox = document.getElementById(fieldCheckboxMap[fieldName]);
                    const input = document.querySelector(`input[name="${fieldName}"]`);
                    const datalist = document.getElementById(fieldName + 's');

                    const shouldRandomize = (checkbox && checkbox.checked && datalist && datalist.options.length > 0)
                    || (input && input.value.trim() === "");

                    if(shouldRandomize) {
                        const options = Array.from(datalist.options);
                        const randomOption = options[Math.floor(Math.random() * options.length)];
                        input.value = randomOption.value;

                        if(fieldName === "figure") {
                            const matchedData = figureMap[randomOption.value];
                            if(matchedData) {
                                figureIdInput.value = matchedData.id;
                                figureStyleInput.value = matchedData.style;
                            } else {
                                figureIdInput.value = -1;
                                figureStyleInput.value = "";
                            }
                        }
                    }
                });

                // handle override personality
                const overridePersonalityCheckbox = document.getElementById('togglePersonality');
                const personUnhingedCheckbox = document.getElementById('personUnhingedCheckbox');
                const personalityTypes = document.getElementById('personalityTypes');

                if(overridePersonalityCheckbox.checked) {
                    let finalStyle = personalityTypes.value;

                    if(personUnhingedCheckbox.checked) {
                        finalStyle += " unhinged";
                    }

                    figureStyleInput.value = finalStyle;
                }


                textInputs.forEach(input => input.disabled = false); // disabled fields don't send values, enable before sending
                form.submit();
            });
        </script>

        <button id="viewRecentBtn" onclick="window.location='recentLetters.php'">View Today's Letters →</button>
    </body>
</html>