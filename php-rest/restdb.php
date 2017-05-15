<?php

function post($request, $mysqli) {
  if (isset($request[0]) && isset($request[1]) && isset($request[2] && isset(request[3] && isset request[4]) {
    $fname=$request[0];
    $lname=$request[1];
    $age=$request[2];
    $email=$request[3];
    $zip=$request[4];
    $sql="SELECT id from tbl_users where lname='$lname'";
    $result = $mysqli->query($sql); echo $mysqli->error;
    if ($result->num_rows > 0) {
      echo "Object already exists!";
      http_response_code(404);
    }
    else {
        $sql = "INSERT into tbl_users (firstname, lastname, age, email, zip) VALUES ('$fname', '$lname', '$age', '$email', '$zip')";
        if ($mysqli->query($sql) === TRUE) {
          echo json_encode(array("firstname"=>$fname,"lastname"=>$lname,"age"=>$age, "email"=>$email, "zip"=>$zip, "action" => "created"));
        }
    else { http_response_code(404); echo $mysqli->error; }
    }
  }
  else {
    echo "You need to set firstname, lastname, age, email, and zip";
    http_response_code(404);
  }
}

function deleter($request, $mysqli){
  $lname=$request[1];
  $sql="SELECT id from tbl_users where lname='$lname'";
  $result = $mysqli->query($sql); echo $mysqli->error;
  if ($result->num_rows > 0) {
    $sql = "DELETE from tbl_users where lname='$lname'";
    $mysqli->query($sql); echo $mysqli->error;
    echo json_encode(array("lastname"=>$lname, "action"=>"deleted"));
  }
  else {
    echo "Object doesn't exist!";
    http_response_code(404);
  }
}

function get($request, $mysqli) {
  $username=$request[0];
  if ($fname=='allusers') 
    $sql="SELECT * from tbl_users";
  else
    $sql="SELECT * from tbl_users where lname='$lname'";
  $result = $mysqli->query($sql); echo $mysqli->error;
  $rows = array();
  while($r = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $r;
  }
  echo json_encode($rows);
}

$host=$_ENV["DB_HOST"];
$dbuser=$_ENV["DB_USER"];
$dbpass=$_ENV["DB_PASS"];
$db='users';

$mysqli = new mysqli($host, $dbuser, $dbpass);
if ($mysqli->connect_errno) {
  http_response_code(404);
  echo "error connecting";
  exit;
}


//$mysqli->query("DROP DATABASE $db");
if (!$mysqli->select_db($db))
{
  $sql = "CREATE DATABASE $db";
  //$sql = "SHOW DATABASES";

  if ($mysqli->query($sql) === TRUE) {
    echo "Database created successfully";
  } else {
    echo "Error creating database: " . $mysqli->error;
  }
}

$mysqli->close();
$table='tbl_users';
$mysqli = new mysqli($host, $dbuser, $dbpass, $db);
if ( !$mysqli->query("SHOW TABLES LIKE '".$table."'")->num_rows ==1 ) {
  $sql = "create table $table (
    firstname VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    age VARCHAR(3) NOT NULL,
    email VARCHAR(50),
    zip VARCHAR(6),
    reg_date TIMESTAMP ,
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY
    )";
  $mysqli->query($sql);
  echo $mysqli->error; #if any
}

$method = $_SERVER['REQUEST_METHOD'];
if (isset($_SERVER['PATH_INFO'])) {
  $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

  switch ($method) {
    case 'GET':
      get($request, $mysqli); break;
    case 'PUT':
      put($request, $bucket); break;
    case 'POST':
      post($request, $mysqli); break;
    case 'DELETE':
      deleter($request, $mysqli); break;
  }
}
else {
  echo "Nothing here, use http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'/fname/lname/age/email/zip to use the API';
}
?>
