<?php
    class FileOpenException extends Exception {
        function __toString() {
            return "FileOpenException ".$this->getCode().": ".$this->getMessage()."<br />"." in ".$this->getFile()
                ." on line ".$this->getLine()."<br />";
        }
    }

    class FileWriteException extends Exception {
        function __toString() {
            return "FileWriteException ".$this->getCode().": ".$this->getMessage()."<br />"." in ".$this->getFile()
                ." on line ".$this->getLine()."<br />";
        }
    }

    class FileLockException extends Exception {
        function __toString() {
            return "FileLockException ".$this->getCode().": ".$this->getMessage()."<br />"." in ".$this->getFile()
                ." on line ".$this->getLine()."<br />";
        }
    }
?>