<?php 

  session_start();
  // CSRF Token create and add as hidden field with form
  /*
  $length = 32;
  $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);

  if(!isset($_SESSION['token'])){
    $_SESSION['token']=$token;
  } */
  
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  //Checking CSRF token
  if(isset($_POST['submit']))
   {
    //if no csrf token with form
      if(!isset(['noscrf']))
      {
          die("INVALID TOKEN");
      }
      //if csrf token is expired or invalid
      if($_POST['noscrf']!=$_SESSION['token'])
      {
        die("INVALID TOKEN");
      }
   }
  include_once '../config/Database.php';
  include_once '../models/Post.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $post = new Posts($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  //we will fetch U_ID from session
  $post->user_id = $data->user_id;
  $post->body = $data->body;
  $post->create_on = $data->create_on;
  $post->privacy = $data->privacy;

  // Create post
  if($post->write()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }
  //Destroying session to invalidate token
  session_destroy();

  ?>