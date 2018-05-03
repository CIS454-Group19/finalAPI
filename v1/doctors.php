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
    // Insert Product
    get_doctors();
    break;
    default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
  }

  function get_doctors()
  {
    global $connection;

    $query="SELECT * FROM users WHERE user_role='doctor'";
    $response=array();
    $result=mysqli_query($connection, $query);
    while($row=mysqli_fetch_assoc($result))
    {
    $response[]=$row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

?>