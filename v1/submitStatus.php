<?php
  // Connect to database
  include("../connection.php");
  $db = new dbObj();
  $connection =  $db->getConnstring();
 
  $request_method=$_SERVER["REQUEST_METHOD"];
  header('Access-Control-Allow-Headers');

  switch($request_method)
  {
    case 'POST':
    // Update Rating
    update_appStatus();
    break;
    default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
  }

  function update_appStatus()
  {
    global $connection;

    $data = json_decode(file_get_contents("php://input"),true);
    $appNum=$data["appNum"];
    $status=$data["status"];


    $query="UPDATE appointment SET appointment_status='".$status."' WHERE appointment_num=".$appNum;
    if(mysqli_query($connection, $query))
    {
    $response=array(
    'status' => 1,
    'status_message' =>'Employee Updated Successfully.'
    );
    }
    else
    {
    $response=array(
    'status' => 0,
    'status_message' =>'Employee Updation Failed.'
    );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }
?>