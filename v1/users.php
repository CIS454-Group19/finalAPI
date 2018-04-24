<?php
  // Connect to database
  include("../connection.php");
  $db = new dbObj();
  $connection =  $db->getConnstring();
 
  $request_method=$_SERVER["REQUEST_METHOD"];
  header('Access-Control-Allow-Headers');

  switch($request_method)
  {
    case 'GET':
    // Retrive Products
    if(!empty($_GET["id"]))
    {
    $id=intval($_GET["id"]);
    get_oneUser($id);
    }
    else
    {
    get_users();
    }
    break;
    case 'POST':
    // Insert Product
    insert_employee();
    break;
    default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
  }

  function get_users()
  {
    global $connection;
    $query="SELECT * FROM users";
    $response=array();
    $result=mysqli_query($connection, $query);
    while($row=mysqli_fetch_assoc($result))
    {
    $response[]=$row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  function get_oneUser($id)
  {
    global $connection;
    $query="SELECT * FROM users";
    if($id != 0)
    {
    $query.=" WHERE user_id=".$id." LIMIT 1";
    }
    $response=array();
    $result=mysqli_query($connection, $query);
    while($row=mysqli_fetch_assoc($result))
    {
    $response[]=$row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  function insert_employee()
  {
  global $connection;
  
  $data = json_decode(file_get_contents('php://input'), true);
  $uid=$data["email"];
  $pwd=$data["password"];
  echo $query="INSERT INTO users SET user_email='".$uid."', user_pwd='".$pwd."'";
  if(mysqli_query($connection, $query))
  {
  $response=array(
  'status' => 1,
  'status_message' =>'Employee Added Successfully.'
  );
  }
  else
  {
  $response=array(
  'status' => 0,
  'status_message' =>'Employee Addition Failed.'
  );
  }
  header('Content-Type: application/json');
  echo json_encode($response);
  }

?>