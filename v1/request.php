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
    insert_request();
    break;
    default:
    header("HTTP/1.0 405 Method Not Allowed");
    break;
  }

  function insert_request()
  {
    global $connection;

    $data = json_decode(file_get_contents('php://input'), true);
    $uid =  $data["uid"]; //NEED TO GET USER_ID FIGURE Out
    $uidVol =  $data["uidVol"]; //NEED TO GET VolunteerID from Table
    $request = $data["details"];
    $date = $data["date"];
    $status = 3;

    echo $query = "INSERT INTO appointment SET user_idPatient = '".$uid."', user_idVolunteer = '".$uidVol."', appointment_detail = '".$request."', appointment_date = '".$date."', appointment_status = '".$status."'";
    if (mysqli_query($connection, $query))
    {
      $respone = array(
        'status' => 1,
        'status_message' => 'Appointment request successful'
      );
    }
    else
    {
      $response = array(
        'status' => 0,
        'status_message' => 'Appointment request failed'
      );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    }
 ?>
