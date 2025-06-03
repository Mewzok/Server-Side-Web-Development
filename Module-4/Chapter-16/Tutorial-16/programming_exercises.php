<?php
    // exercise 1
    AuthUserFile var/www/.htpass
    AuthType Basic
    AuthName "Authorization Needed"

    // exericse 2
    ErrorDocument 401 /pmwd/chapter16/secret/rejection.html

    // exercise 3
    GRANT SELECT
    ON auth.*
    TO 'webauth';

    // exercise 4
    if(password_verify($password, $hash)) {
        // OK passwords match
    }

    // exercise 5
    .htpasswd
?>