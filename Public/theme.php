<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// check theme cookie
if (isset($_SESSION['mode']) && $_SESSION['mode'] == 'dark') {
    echo ('<html lang="en" data-theme="dark">');
} else {
    echo ('<html lang="en" data-theme="light">');
}
