<?php
    session_start();
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

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
    include_once '../models/Posts.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new Posts($db);

    $post->u_id = isset($_GET['id']) ? $_GET['id'] : die();
    // Blog post query
    $result = $post->display($post->u_id);
  // Get row count
     $num = $result->rowCount();
    // Check if any posts
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        
        'body' => html_entity_decode($body),
        'author' => $username,
        'Creation_Date' => $create_on,
        
      );

      // Push to "data"
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
  //Destroying session to invalidate token
  session_destroy();



?>