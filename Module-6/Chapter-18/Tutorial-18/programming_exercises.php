<?php
    // exercise 1
    $ip = gethostbyname($host);

    // exercise 2
    $email = explode('@', $email);
    $emailhost = $email[1];

    // exercise 3
    $conn = ftp_connect($host);
    if(!$conn) {
        echo 'Error: Could not connect to '.$host;
        exit;
    }
    echo 'Connected to '.$host.'<br />';

    // exercise 4
    ftp_pasv($conn, true);

    // exercise 5
    $remotetime = ftp_mdtm($conn, $remotefile);
/>