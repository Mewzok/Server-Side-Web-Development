<?php
    // exercise 1
    // dbconnect.php
    $db_server = 'hostname';
    $db_user_name = 'username';
    $db_password = 'password';
    $db_name = 'dbname';

    // different file
    include('dbconnect.php');

    $conn = @new mysqli($db_server, $db_user_name, $db_password, $db_name);

    // exercise 2
    $users = `grep -i smith /home/httpd/www/phonenums.txt`;

    // exercise 3
    phpinfo();

    // exercise 4
    // httpd.conf

    // exercise 5
    <Files ~ "\.inc$">
        Order allow, deny
        Deny from all
    </Files>
?>