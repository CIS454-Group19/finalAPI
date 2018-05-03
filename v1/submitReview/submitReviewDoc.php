<?php
  // Connect to database
  include("../../connection.php");
  $db = new dbObj();
  $connection =  $db->getConnstring();
 
  $request_method=$_SERVER["REQUEST_METHOD"];
  header('Access-Control-Allow-Headers');

  switch($request_method)
  {
    case 'POST':
    // Update Rating
    update_user();
    break;
    default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
  }

  function update_user()
  {
    global $connection;

    $data = json_decode(file_get_contents("php://input"),true);
    $uid=$data["uid"];
    $volId=$data["volId"];
    $rating=$data["rating"];
    $visitCount=$data["visitCount"];
    $newSum=$data["updatedSum"];
    $reviewDone=$data["reviewDone"];
    $appDate=$data["appDate"];

    $query1="UPDATE users SET rating='".$rating."', number_visits='".$visitCount."', rating_sum='".$newSum."' WHERE user_id=".$volId;
    if(mysqli_query($connection, $query1))
    {
    $response1=array(
    'status' => 1,
    'status_message' =>'Employee Updated Successfully.'
    );
    }
    else
    {
    $response1=array(
    'status' => 0,
    'status_message' =>'Employee Updation Failed.'
    );
    }

    $query2= "UPDATE appointment SET vol_review= '$reviewDone' 
              WHERE user_idPatient = '$volId'
              AND user_idVolunteer = '$uid'
              AND appointment_date = '$appDate'";
    if(mysqli_query($connection, $query2))
    {
    $response2=array(
    'status' => 1,
    'status_message' =>'Employee Updated Successfully.'
    );
    }
    else
    {
    $response2=array(
    'status' => 0,
    'status_message' =>'Employee Updation Failed.'
    );
    }


    header('Content-Type: application/json');
    echo json_encode($response1);
    echo json_encode($response2);
  }
?>