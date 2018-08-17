<?php
session_start();

$_SESSION = array();
session_destroy();

header("Location:./user_logout_success.php");



