<?php
    class Page {
        // class Page's attributes
        private $content;
        private $title = "Frog Parts";
        private $keywords = "Frog Parts";

        public function __construct($title = "Frog Parts", $keywords = "Frog Parts") {
            $this->title = $title;
            $this->keywords = $keywords;
        }

        public function __set($name, $value) {
            $this->$name = $value;
        }

        public function Display() {
            echo "<html>\n<head>\n";
            $this -> DisplayTitle();
            $this -> DisplayKeywords();
            $this -> DisplayStyles();
            echo "</head>\n<body>\n";
            $this -> DisplayHeader();
            echo $this->content;
            $this -> DisplayFooter();
            echo "</body>\n</html>\n";
        }

        public function DisplayTitle() {
            echo "<title>".$this->title."</title>";
        }

        public function DisplayKeywords() {
            echo "<meta name='keywords' content='".$this->keywords."'/>";
        }

        public function DisplayStyles() {
            ?>
            <link href="fp_styles.css" type="text/css" rel="stylesheet">
            <?php
        }

        public function DisplayHeader() {
            ?>
            <!-- page header -->
            <a href="fp_form.php" id="headerLink">
                <header class="frog-header">
                    <img id="frogLogo" src="resources/frogpartslogo.png" alt="FrogParts logo" />
                    <h1 id="frogTitle">Frog Parts</h1>
                </header>
            </a>
            <?php
        }

        public function DisplayFooter() {
            ?>
            <!-- page footer -->
            <footer class="frog-footer">
                <p>Frog Parts<br />
                Please do not contact me.</p>
            </footer>
            <?php
        }

        public function DisplayFeedback($name, $color, $arm, $leg) {
            ?>
            <form action="fp_feedbackform.php" method="post">
                <input type="hidden" name="frogname" value="<?php echo htmlspecialchars($name); ?>">
                <input type="hidden" name="frogcolor" value="<?php echo htmlspecialchars($color); ?>">
                <input type="hidden" name="frogarm" value="<?php echo htmlspecialchars($arm); ?>">
                <input type="hidden" name="frogleg" value="<?php echo htmlspecialchars($leg); ?>">
                <button class="frog-feedback-button" type="submit">🐸 Frog Feedback</button>
            </form>
            <?php
        }
    }
?>