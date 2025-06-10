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
        <?php
            $page->DisplayHeader();
        ?>
        <div id="generatorFormDiv">
            <form action="generateLetter.php" method="post">
                <table style="border: 0px;">
                    <tr>
                        <td>Historical Figure</td>
                        <td>
                            <input type="text" list="historicalFigures" />
                            <datalist id="historicalFigures">
                                <option>Napoleon Bonaparte</option>
                                <option>Julius Caesar</option>
                                <option>George Washington</option>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="hfRandomCheckbox" name="hfRandomCheckbox">
                            <label for="hfRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Misdeed</td>
                        <td>
                            <input type="text" list="misdeeds" />
                            <datalist id="misdeeds">
                                <option>Misdeed 1</option>
                                <option>Misdeed 2</option>
                                <option>Misdeed 3</option>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="mdRandomCheckbox" name="mdRandomCheckbox">
                            <label for="mdRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Reason</td>
                        <td>
                            <input type="text" list="reasons" />
                            <datalist id="reasons">
                                <option>Reason 1</option>
                                <option>Reason 2</option>
                                <option>Reason 3</option>
                            </datalist>
                        </td>
                        <td>
                            <input type="checkbox" id="rsRandomCheckbox" name="rsRandomCheckbox">
                            <label for="rsRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Tone</td>
                        <td>
                            <select name="tone" id="tone">
                                <option value="tone1">Tone 1</option>
                                <option value="tone2">Tone 2</option>
                                <option value="tone3">Tone 3</option>
                        </td>
                        <td>
                            <input type="checkbox" id="tnRandomCheckbox" name="tnRandomCheckbox">
                            <label for="tnRandomCheckbox">Randomize</label><br>
                        </td>
                    </tr>
                    <td>
                        <input type="checkbox" id="randomizeAllChecbox" name="randomizeAllCheckbox">
                        <label for="randomizeAllCheckbox">Randomize All</label><br>
                    </td>
                    <tr>
                        <td>
                            <input type="submit" value="Generate Apology Letter" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>