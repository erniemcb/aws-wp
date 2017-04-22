<?php

function post($request, $mysqli) {
  if (isset($request[0]) && isset($request[1])) {
    $username=$request[0];
    $fname=$request[1];
    $sql="SELECT id from tbl_users where username='$username'";
    $result = $mysqli->query($sql); echo $mysqli->error;
    if ($result->num_rows > 0) {
      echo "Object already exists!";
      http_response_code(404);
    }
    else {
        $sql = "INSERT into tbl_users (username, firstname) VALUES ('$username', '$fname')";
        if ($mysqli->query($sql) === TRUE) {
          echo json_encode(array("username"=>$username,"firstname"=>$fname,"action" => "created"));
        }
    else { http_response_code(404); echo $mysqli->error; }
    }
  }
  else {
    echo "You need to set both username and firstname";
    http_response_code(404);
  }
}

function deleter($request, $mysqli){
  $username=$request[0];
  $sql="SELECT id from tbl_users where username='$username'";
  $result = $mysqli->query($sql); echo $mysqli->error;
  if ($result->num_rows > 0) {
    $sql = "DELETE from tbl_users where username='$username'";
    $mysqli->query($sql); echo $mysqli->error;
    echo json_encode(array("username"=>$username, "action"=>"deleted"));
  }
  else {
    echo "Object doesn't exist!";
    http_response_code(404);
  }
}

function get($request, $mysqli) {
  $username=$request[0];
  if ($username=='allusers') 
    $sql="SELECT * from tbl_users";
  else
    $sql="SELECT * from tbl_users where username='$username'";
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
    email VARCHAR(50),
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
  echo "Nothing here, use http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'/username/firstname to use the API';
}
?>
