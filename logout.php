<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: no-referrer-when-downgrade");
session_unset();
session_destroy();
header("Location: index.html");
exit;

?>