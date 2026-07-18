<?php
require __DIR__ . '/auth.php';
doLogout();
header('Location: /admin');
exit;
