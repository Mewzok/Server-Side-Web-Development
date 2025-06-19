<?php
    class Page {
        // class Page's attributes
        private $content;
        private $title = "Historical Apology Generator";
        private $keywords = "historical apology generator";

        public function __construct($title = "Historical Apology Generator", 
                $keywords = "historical apology generator") {
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
            <link href="style.css" type="text/css" rel="stylesheet">
            <?php
        }

        public function DisplayHeader() {
            ?>
            <!-- page header -->
            <header class="page-header">
                <a href="index.php" id="headerLink">
                    <h1 id="pageTitle">Historical Apology Generator</h1>
                </a>
            </header>
            <?php
        }

        public function backToHomeButton() {
            ?>
            <button id="backToHomeBtn" onclick="window.location='index.php'">← Back to Generator</button>
            <?php
        }
    }
?>