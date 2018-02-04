<?php

$con = mysqli_connect($db_host,$db_user,$db_pass,$db_database);

if(!$con) {
    die("<h1>Database Error</h1><h3>".mysqli_error($con)."</h3>");
}
    error_reporting(E_ALL);
    session_start();

function authenticate() {
    if(!isLoggedIn())
        header("Location:login.php");
}
function isLoggedIn() {
    return isset($_SESSION["login"]) && ($_SESSION["login"]===true);
}

function _s($n) {
    return ($n>1)?"s":"";
}
?>