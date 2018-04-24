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
    // Insert User
    // insert_user();
    login();
    break;
    default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
  }

  // function insert_user()
  // {
  //   global $connection;

    // $data = json_decode(file_get_contents('php://input'), true);
    // $uid=$data["email"];
    // $pwd=$data["password"];

  //   $sql = "SELECT * FROM users WHERE user_email='$uid'";
	// 	$result = mysqli_query($connection, $sql);
	// 	$resultCheck = mysqli_num_rows($result);
	// 	if ($resultCheck < 1) {
	// 		exit();
	// 	} else {
	// 		if ($row = mysqli_fetch_assoc($result)) {
				
  //       $passwordGet = "SELECT user_pwd FROM users WHERE user_email='$uid'";
  //       $response=array();
	// 			$checkPwd = mysqli_query($connection, $passwordGet);
	// 			$checker = mysqli_fetch_assoc($checkPwd);
	// 			$lastCheck = $checker['user_pwd'];
				

	// 			if ($pwd != $lastCheck) {
	// 				exit();

	// 			} elseif ($pwd == $lastCheck) {
  //         $response[]=$lastCheck;
	// 			}
	// 		}
  //   }
  //   header('Content-Type: application/json');
  //   echo json_encode($response);
  // }

  function login ()
  {
    global $connection;

    $data = json_decode(file_get_contents('php://input'), true);
    $uid=$data["email"];
    $pwd=$data["password"];

    $query="SELECT * FROM users WHERE user_email='$uid'";
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