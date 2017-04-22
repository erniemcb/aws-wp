<?php
echo "<pre>";
echo $_SERVER['SERVER_ADDR'];
$host=gethostbyname($_ENV["DB_HOST"]);
echo $_ENV["DB_HOST"];
echo $host;
$dbuser=$_ENV["DB_USER"];
echo $dbuser;
$dbpass=$_ENV["DB_PASS"];
echo $dbpass;
$db='users';
echo "</pre>";
?>
