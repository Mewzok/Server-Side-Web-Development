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
            Date Modified: 06/10/2025

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
        <?php $page->DisplayHeader(); ?>
        <div id="generatorFormDiv">
            <form action="generate.php" method="post">
                <table style="border: 0px;">
                    <tr>
                        <td>Historical Figure</td>
                        <td>
                            <input type="text" name="figure" list="figures"/>
                            <datalist id="figures">
                                <option>Napoleon Bonaparte</option>
                                <option>Julius Caesar</option>
                                <option>George Washington</option>
                                <option>Montezuma</option>
                                <option>Barry Goldwater</option>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="figRandomCheckbox" name="figRandomCheckbox">
                            <label for="figRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Recipient</td>
                        <td>
                            <input type="text" name="recipient" list="recipients" />
                            <datalist id="recipients">
                                <option>Recipient 1</option>
                                <option>Recipient 2</option>
                                <option>Recipient 3</option>
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
                                <option>Reason 1</option>
                                <option>Reason 2</option>
                                <option>Reason 3</option>
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
                                <option>Place 1</option>
                                <option>Place 2</option>
                                <option>Place 3</option>
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
                                <option>Consequence 1</option>
                                <option>Consequence 2</option>
                                <option>Consequence 3</option>
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
                                <option>Justification 1</option>
                                <option>Justification 2</option>
                                <option>Justification 3</option>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="justRandomCheckbox" name="justRandomCheckbox">
                            <label for="justRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Talent</td>
                        <td>
                            <input type="text" name="talent" list="talents" />
                            <datalist id="talents">
                                <option>Talent 1</option>
                                <option>Talent 2</option>
                                <option>Talent 3</option>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="talRandomCheckbox" name="talRandomCheckbox">
                            <label for="talRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Feat</td>
                        <td>
                            <input type="text" name="feat" list="feats" />
                            <datalist id="feats">
                                <option>Feat 1</option>
                                <option>Feat 2</option>
                                <option>Feat 3</option>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="featRandomCheckbox" name="featRandomCheckbox">
                            <label for="featRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Fact</td>
                        <td>
                            <input type="text" name="fact" list="facts" />
                            <datalist id="facts">
                                <option>Fact 1</option>
                                <option>Fact 2</option>
                                <option>Fact 3</option>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="factRandomCheckbox" name="factRandomCheckbox">
                            <label for="factRandomCheckbox">Randomize</label><br>
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
            </form>
        </div>
        <script>
            // handle randomize all button
            const randomizeAllCheckbox = document.getElementById('randomizeAllCheckbox');
            const otherCheckboxes = document.
                querySelectorAll('input[type="checkbox"]:not(#randomizeAllCheckbox)');
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
        </script>
    </body>
</html>