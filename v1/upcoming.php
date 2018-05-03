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
    get_upcoming();
    break;

    default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
  }

  function get_upcoming() {
    $date = date("Y-m-d");
    global $connection;

    $data = json_decode(file_get_contents('php://input'), true);
    $uid=$data["uid"];

    $query = "SELECT u.user_id, u.user_first, u.user_last, u.user_location, u.phone_number,
    ap.appointment_detail, ap.appointment_date, ap.user_idVolunteer
    FROM users AS u, appointment AS ap
    WHERE appointment_date > '$date'
    AND u.user_id = ap.user_idVolunteer
    AND ap.appointment_status = 1
    AND ap.user_idPatient = '$uid'";

    $response = array();
    $result = mysqli_query($connection, $query);

    while($row=mysqli_fetch_assoc($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }
 ?>
