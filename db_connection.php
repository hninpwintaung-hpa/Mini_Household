<?php

$dbhost = '127.0.0.1';
$dbuserName = "root";
$dbPwd = '';
$dbName = 'mini_household';

mysqli_report(MYSQLI_REPORT_OFF);
//    $con=mysqli_connect("localhost","root","","myApp");
$conn = mysqli_connect($dbhost, $dbuserName, $dbPwd);

if (!$conn) {
    die("error");
}
if (!mysqli_select_db($conn, $dbName)) {
    die("cannot select database name");
}
