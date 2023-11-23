<?php session_start();
// testear
session_unset();
session_destroy();
echo "<script> window.location = '" . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/';</script>";