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
    insert_user();
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

  function insert_user()
  {
  global $connection;
  
  $data = json_decode(file_get_contents('php://input'), true);
  $firstName=$data["firstName"];
  $lastName=$data["lastName"];
  $ema=$data["regEmail"];
  $pwd=$data["regPassword"];
  $uid=$data["username"];
  $loc=$data["location"];
  $bio=$data["bio"];
  $rating=$data["rating"];
  $phone=$data["phone"];
  $visits=$data["visits"];
  $role=$data["role"];

  echo $query="INSERT INTO users SET user_first='".$firstName."', user_last='".$lastName."', user_email='".$ema."', user_pwd='".$pwd."', user_uid='".$uid."', user_location='".$loc."', user_bio='".$bio."', phone_number='".$phone."', rating='".$rating."', number_visits='".$visits."', user_role='".$role."'";
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