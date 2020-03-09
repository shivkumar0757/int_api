<?php 
  class Posts {
    // DB stuff
    private $conn;
    private $table = 'posts';

    //post properties
    public  $user_id;  //owner or author
    public  $body;
    public  $create_on;
    public  $group_id;
    public $privacy;


    // Constructor with DB conn Obj
    public function __construct($db) {
        $this->conn = $db;
      }



    // Get Posts Associated with user
    public function display($u_id)
    {
        $this->u_id=$u_id;
        $query= "SELECT posts.body,users.username, posts.create_on
        from posts,users,followers 
        WHERE 
        posts.user_id = followers.user_id
        AND followers.follower_id= ".$this->u_id."
        AND posts.user_id = users.id
        
        Union
        
        SELECT DISTINCT posts.body,users.username, posts.create_on
        from posts,users,membership 
        WHERE posts.user_id in
        (SELECT member_id from membership WHERE membership.g_id IN 
        (SELECT membership.g_id FROM membership 
        where membership.member_id = ".$this->u_id.") )
        AND posts.privacy= 2
        AND posts.user_id = users.id
        order by create_on
        ";
    //Prepare statement
        $stmt= $this->conn->prepare($query);
    
    //clean data
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    // Bind data
    $stmt->bindParam(1, $this->user_id);
    $stmt->bindParam(2, $this->user_id);
    // Execute query
        $stmt->execute();
        return $stmt;
    }


    //Share post to users and friends
    public function write(){
        // Create query
        $query= "INSERT INTO `posts` ( `user_id`, `body`, `create_on`, `privacy`) 
        VALUES ('4', 'this is third post by ThFourree', CURDATE(), '2');";
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->create_on = htmlspecialchars(strip_tags($this->create_on));
        $this->group_id = htmlspecialchars(strip_tags($this->group_id));
        $this->privacy = htmlspecialchars(strip_tags($this->privacy));
        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':create_on', $this->create_on);
        $stmt->bindParam(':group_id', $this->group_id);
        $stmt->bindParam(':privacy', $this->privacy);
       // Execute query
       if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}   